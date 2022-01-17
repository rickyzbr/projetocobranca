<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Clients;
use App\Models\Releases;
use App\Models\ReleaseStatus;
use App\Models\MonthReleases;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use App\Charts\SampleChart;

class ReleasesGraphicsController extends Controller
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
        $releases = Releases::all();
        $totalAmount = Releases::sum('amount');
        $users = User::all();
        $clients = Clients::all();
        $statuses = ReleaseStatus::all(); 

        $chart_releases = DB::table('release_statuses')
                        ->join('releases', 'release_statuses.id', '=', 'releases.id')
                        ->get();

                $chart = SampleChart::database($chart_releases, 'bar', 'highcharts') 
                            ->title("Produtos Mais Acessados") 
                            ->elementLabel("Produtos") 
                            ->labels('2 days ago', 'Yesterday', 'Today')
                            ->dimensions(1000, 500) 
                            ->colors(['red', 'blue', 'green', 'Brown', 'black', 'yellow', 'purple', 'orange', 'cyan'])
                            ->responsive(true) 
                            ->groupBy('name');

    	//return view('releases.graphics')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));
 
    }
}
