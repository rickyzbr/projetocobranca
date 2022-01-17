<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clients;
use App\Models\PartnersClient;
use App\Models\Releases;
use App\Models\ReleaseStatus;
use App\Models\MonthReleases;
use App\Models\TypeBanks;
use App\Models\Agreements;
use WGenial\NumeroPorExtenso\NumeroPorExtenso;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Arr;
use DB;

class ReleasesAgreementsController extends Controller
{
    private $agreements;
    private $totalPage = 100;
    private $path = 'agreements';   

    public function __construct(Agreements $agreements)
    {
        $this->agreements = $agreements;    
    } 

    public function index()
    {

        $agreements = Agreements::all();

        return view('agreements.index',compact('agreements'));
    }
    
    public function create(Request $request, $id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $date = Carbon::now();
        $agreement = $request->session()->get('agreement');
        $user = auth()->user();

        $statuses = ReleaseStatus::all();
        $banks = TypeBanks::all();
        $releases = Releases::where('client_id', '=', $client->id)->where('assigned_to', '=', $user->id)->where('status_id', '=', 2)->get();
        $total = Releases::where('client_id', '=', $client->id)->where('status_id', '=', 2)->where('assigned_to', '=', $user->id)->sum('amount'); 
        $users = User::all();
        $partners = PartnersClient::where('client_id', '=',  $client->id)->get();
        return view ('agreements.create', compact ('agreement', 'date', 'banks', 'client', 'releases', 'statuses', 'total', 'partners', 'users'));
    }

    public function simulation(Request $request)
    {

        $date = Carbon::now();
        $dataForm = $request->except('_token');

        $parcelas = $dataForm['installments'];
        $amount = number_format($dataForm['agreements_amount'], 2, '.', '');
        $client_id = $dataForm['client_id'];
        $partner_id = $dataForm['partner_id'];


        $valorparcela = number_format(10000, 2, '.', '') / $parcelas;
        $date = Carbon::now();
        $due_date = Carbon::create($dataForm['due_date']);

        return view('agreements.simulation', compact('parcelas', 'valorparcela', 'date', 'due_date', 'client_id', 'partner_id', 'date'));
        
    }

    public function store(Request $request, $id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }
    
        
        DB::beginTransaction();

        $user = auth()->user();

        $dataForm = $request->except('_token');
        $status_id = $dataForm['status_id'];
        $partner_id =  $dataForm['partner_id'];
        $inflow = $dataForm['inflow'];
        $amount = $dataForm['agreements_amount']; 
        $due_date = $dataForm['due_date'];
        $parcelas = $dataForm['installments'];

        $valorparcela = number_format($amount - $inflow, 2, '.', '') / $parcelas;
        $balance = number_format($amount - $inflow, 2, '.', '');

        $insert = auth()->user()->agreements()->create([
            'client_id' => $client->id,
            'partner_id' => $partner_id,
            'agreements_amount' => $amount,
            'balance_amount' => $balance, 
            'parcel_amount' => $valorparcela,
            'inflow_amount' => $inflow,
            'installments' => $parcelas,
            'due_date' => $due_date,
        ]);        

        $last_agreement = Agreements::orderBy('created_at', 'desc')
                ->take(1)
                ->get();
        
        foreach ($last_agreement as $agreement)             
            $releases = [];
                for($i=1; $i <= $parcelas; $i++) 
                    $insert_releases = auth()->user()->release()->create([   
                    'type_id' => $dataForm['type_id'], 
                    'agreement_id' => $agreement->id,
                    'status_id' => $dataForm['status_id'], 
                    'client_id' => $dataForm['client_id'],
                    'partner_id' => $partner_id,
                    'parcel' => $i,
                    'assigned_to' => $user->id,
                    'issue_date' => date('Ymd'),
                    'due_date' =>  $i == 1 ? Carbon::parse($due_date)->format('Ymd') : Carbon::parse($due_date)->subMonth()->addMonths($i)->format('Ymd'),                    
                    'amount' => $valorparcela,
                 // Populando cada posição do array com um array contendo os valores a serem persistidos
                ]); 

                  

            foreach ($request->checkbox as $checkbox) {

                $insert_releases = auth()->user()->releasesofagreements()->create([
                    'client_id' => $client->id,
                    'partner_id' => $partner_id,
                    'release_id' => $checkbox,
                    'agreement_id' => $agreement->id,
                ]);

                $releases                = Releases::find($checkbox);
                $releases->status_id     = 6;
                $releases->save();
            };

            
        if ($insert && $insert_releases ){

            DB::commit();
        
            return redirect()
                        ->route ('releases.index')
                        ->with('success', 'A Nova Cobrança foi Lançada Com sucesso! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function view($id)
    {
        if (!$agreement = Agreements::find($id)){
            return redirect()->back();
        }    
        $extenso = new NumeroPorExtenso;
        
        return view ('agreements.view', compact('agreement', 'extenso'));      
    }
}
