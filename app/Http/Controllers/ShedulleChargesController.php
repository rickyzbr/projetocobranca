<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clients;
use App\Models\Releases;
use App\Models\ReleaseStatus;
use App\Models\ReleasesCharge;
use Redirect,Response;


class ShedulleChargesController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = ReleasesCharge::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         return Response::json($data);
        }
        return view('releases_users.calendar');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = ReleasesCharge::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         return Response::json($data);
        }
        return view('releases_users.calendar');
    }


}
