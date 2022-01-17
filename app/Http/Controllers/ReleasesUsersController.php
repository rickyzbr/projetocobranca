<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clients;
use App\Models\Releases;
use App\Models\ReleaseStatus;
use App\Models\ReleasesCharge;
use App\Models\MonthReleases;
use App\Models\PartnersClient;
use App\Models\TypeReleases;
use App\Models\ChargeHistorics;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class ReleasesUsersController extends Controller
{
    private $releases;
    private $totalPage = 15;
    private $path = 'releases';   

    public function __construct(Releases $releases)
    {
        $this->releases = $releases;
    }  

    public function index(Clients $clients)
    {
        $releases_old = $this->releases->paginate($this->totalPage);
        $user = auth()->user();
        $releases = Releases::where('assigned_to', $user->id)->groupBy('client_id')->paginate($this->totalPage);
        $statuses = ReleaseStatus::all();
        $months = MonthReleases::all();
        $users = User::all();
        $clients = Clients::all();

        $clients_old = DB::table('clients')
                        ->join('releases', 'releases.client_id', '=', 'clients.id')
                        ->take(50)
                        ->get();

        return view('releases_users.index', compact ('releases', 'statuses', 'months', 'clients', 'users'));   
    }

    public function list($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $user = auth()->user();

        $releases = Releases::where('client_id', $client->id)->where('assigned_to', $user->id)->where('status_id', 3)->get();
        $countPartners = Releases::where('client_id', '=', $client->id)->where('partner_id', '=', null)->where('assigned_to', '=', $user->id)->count();
        $partners = PartnersClient::where('client_id', '=', $client->id)->get();
        $statuses = ReleaseStatus::where('id', 2)->get();
        $typeReleases = TypeReleases::all();
        $mytime = Carbon::now();
    
        return view ('releases_users.list', compact('client', 'releases', 'countPartners', 'statuses', 'typeReleases', 'mytime'));      
    }

    public function charge_store(Request $request)
    {
        
        DB::beginTransaction();

        $dataForm = $request->except('_token');
        
        $insert = auth()->user()->charge()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'Você Cadastrou a Cobrança da Franquia com Sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function charge_schedule(Request $request)
    {
        
        DB::beginTransaction();

        $dataForm = $request->except('_token');
        
        $insert = auth()->user()->schedule()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'Você Agendou a Cobrança da Franquia com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function charge_schedule_ajax(Request $request)
    {
        if ($request->ajax()){
            if (!empty($request->checkbox)) {            

                foreach ($request->checkbox as $checkbox) {
                    $releases                = Releases::find($checkbox);
                    $releases->partner_id     = $request->partner;
                    $releases->save();

                }
                
                return response()->json(['success'=>"Você Cadastrou um CPF do Sócio com Sucesso !"]);
            } else {
                return redirect()
                            ->back()
                            ->with('error', 'Ops, Deu algum erro' );
            }
        }
    }

    public function charges($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $user = auth()->user();

        $charges = ReleasesCharge::where('client_id', '=', $client->id)->where('user_id', '=', $user->id)->get();
        $partners = PartnersClient::where('client_id', '=', $client->id)->get();
        $mytime = Carbon::now();
    
        return view ('releases_users.charges', compact('client', 'charges', 'mytime'));      
    }

    public function historic($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $user = auth()->user();

        $historics = ChargeHistorics::where('client_id', '=', $client->id)->where('user_id', '=', $user->id)->get();
        $mytime = Carbon::now();
    
        return view ('releases_users.historics', compact('client', 'historics', 'mytime'));      
    }

    public function update_status(Request $request)
    {
        if ($request->ajax()){
            if (!empty($request->checkbox)) {            

                foreach ($request->checkbox as $checkbox) {
                    $releases                = Releases::find($checkbox);
                    $releases->status_id     = $request->status;
                    $releases->save();

                }
                
                return response()->json(['success'=>"Você Alterou os Status dos Lançamentos com Sucesso !"]);
            } else {
                return redirect()
                            ->back()
                            ->with('error', 'Ops, Deu algum erro' );
            }
        }
    }

    public function manage($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $user = auth()->user();

        $releases = Releases::where('client_id', '=', $client->id)->where('assigned_to', '=', $user->id)->where('status_id', '=', 2)->get();
        $countPartners = Releases::where('client_id', '=', $client->id)->where('partner_id', '=', null)->where('assigned_to', '=', $user->id)->count();
        $total = Releases::where('client_id', '=', $client->id)->where('status_id', '=', 2)->where('assigned_to', '=', $user->id)->sum('amount');
        $partners = PartnersClient::where('client_id', '=', $client->id)->get();
        $statuses = ReleaseStatus::all();
        $typeReleases = TypeReleases::all();
        $date = Carbon::now();
        $mytime = Carbon::now();
    
        return view ('releases_users.manage', compact('client', 'releases',  'date', 'countPartners', 'statuses', 'typeReleases', 'total', 'partners', 'mytime'));      
    }

    public function simulation(Request $request, $id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $date = Carbon::now();
        $mytime = Carbon::now();
        $dataForm = $request->except('_token');

        $parcelas = $dataForm['installments'];
        $inflow = $dataForm['inflow'];
        $amount = str_replace (',', '.', str_replace ('.', '', $dataForm['agreements_amount']));
        $client_id = $dataForm['client_id'];


        $valorparcela = ($amount - $inflow) / $parcelas;
        $due_date = Carbon::create($dataForm['due_date']);

        return view('releases_users.simulation', compact('client', 'mytime', 'parcelas', 'inflow', 'valorparcela', 'date', 'due_date', 'client_id', 'date'));
        
    }

    
}


