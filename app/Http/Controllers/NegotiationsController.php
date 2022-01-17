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

class NegotiationsController extends Controller
{
    private $releases;
    private $totalPage = 15;
    private $path = 'releases';   

    public function __construct(Releases $releases)
    {
        $this->releases = $releases;
    }  

    public function index()
    {
        $releases_old = $this->releases->paginate($this->totalPage);
        $user = auth()->user();
        $releases = Releases::where('assigned_to', $user->id)->where('status_id', '=', 2)->groupBy('client_id')->paginate($this->totalPage);
        $statuses = ReleaseStatus::all();
        $months = MonthReleases::all();
        $users = User::all();
        $clients = Clients::all();

        $clients_old = DB::table('clients')
                        ->join('releases', 'releases.client_id', '=', 'clients.id')
                        ->take(50)
                        ->get();

        return view('negotiations.index', compact ('releases', 'statuses', 'months', 'clients', 'users'));   
    }
}
