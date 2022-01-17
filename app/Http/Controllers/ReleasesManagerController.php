<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clients;
use App\Models\Releases;
use App\Models\Partners;
use App\Models\PartnersClient;
use App\Models\ReleaseStatus;
use App\Models\MonthReleases;
use App\Models\TypeReleases;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class ReleasesManagerController extends Controller
{
    private $clients;
    private $totalPage = 15;
    private $path = 'clients';  

    public function __construct (Clients $clients)
    {
        $this->clients = $clients;
    }

    public function index()
    {
        
        $releases = Releases::where('status_id', 3)->groupBy('client_id')->get();
        $totalClients = Clients::count();
        $countReleases = Releases::where('client_id')->groupBy('client_id')->count();
        $clients = Clients::all();

        return view('releases_manager.index', compact ('clients', 'totalClients', 'releases', 'countReleases'));   
    }

    public function show($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $release = Releases::where('client_id', '=', $client->id);
        $countPartners = Releases::where('client_id', '=', $client->id)->where('partner_id', '=', null)->count();
        $partners = PartnersClient::where('client_id', '=', $client->id)->get();
    
        return view ('releases_manager.view', compact('client', 'release', 'countPartners'));      
    }

    public function listOfParners($id)
    {
        if (!$partner = Partners::find($id)){
            return redirect()->back();
        }
        $users = User::all();
        $releases = Releases::where('partner_id', '=', $partner->id)->paginate($this->totalPage);;
    
        return view ('releases_manager.releases_partner', compact('partner', 'releases', 'users'));      
    }

    public function manager($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $releases = Releases::where('client_id', '=', $client->id)->get();
        $typeReleases = TypeReleases::all();
        $users = User::all();
    
        return view ('releases_manager.releases_manager', compact('client', 'releases', 'typeReleases', 'users'));      
    }

    public function update_assigned(Request $request)
    {
        if ($request->ajax()){
            if (!empty($request->checkbox)) {            

                foreach ($request->checkbox as $checkbox) {
                    $releases                = Releases::find($checkbox);
                    $releases->assigned_to     = $request->user;
                    $releases->save();

                }
                
                return response()->json(['success'=>"A Categoria foi Deletada Com sussesso !"]);
            } else {
                return redirect()
                            ->back()
                            ->with('error', 'Ops, Deu algum erro' );
            }
        }
    }

    public function update_partner(Request $request)
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
}
