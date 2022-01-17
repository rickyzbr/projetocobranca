<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Clients;
use App\Models\PartnersClient;
use App\Models\Partners;
use App\Models\Releases;
use App\Models\ReleaseStatus;
use App\Models\ClientStatus;
use Carbon\Carbon;
use DB;

class ReleasesClientController extends Controller
{  

    function __construct(Releases $release, Clients $client)
    {
        $this->release = $release;
        $this->client = $client;
    }  

    public function index_old($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $mytime = Carbon::now();
        $statuses = ReleaseStatus::all(); 
        $changes = ReleaseStatus::all(); 
        $total = Releases::where('client_id', '=', $client->id)->where('status_id', '=', 3)->sum('amount');
       
        

        return view ('clients.releases', compact('client', 'statuses', 'changes', 'total', 'mytime')); 
    }

    public function index($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }

        $mytime = Carbon::now();
        $statuses = ReleaseStatus::all(); 
        $changes = ReleaseStatus::all(); 
        $total = Releases::where('client_id', '=', $client->id)->where('status_id', '=', 3)->sum('amount');        

        return view ('clients.releases', compact('client', 'statuses', 'changes', 'total', 'mytime')); 
    }
}
