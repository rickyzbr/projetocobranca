<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Clients;
use App\Models\PartnersClient;
use App\Models\Partners;
use App\Models\Releases;
use App\Models\ReleaseStatus;
use App\Models\TypeReleases;
use DB;

class HomeController extends Controller
{

    public function __construct(TypeReleases $typereleases)
    {
        $this->typereleases = $typereleases;
    }


    public function index()
    {
        $user = auth()->user();
        $typereleases = TypeReleases::where('featured', 1)->take(4)->get();
        $releases = Releases::where('assigned_to', $user->id)->groupBy('client_id')->get();
        $totalReleases = Releases::count();
        $clients = Clients::all();

        $statuses = ReleaseStatus::all(); 

        return view('home.index', compact('typereleases', 'totalReleases', 'clients', 'releases', 'user'));  
    }
}
