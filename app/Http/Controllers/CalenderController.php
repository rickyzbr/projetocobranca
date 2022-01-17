<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReleasesCharge;
use App\Models\CrudEvents;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class CalenderController extends Controller
{

    public function index(Request $request)
    {
  
        if($request->ajax()) {
       
             $data = ReleasesCharge::where('user_id', auth()->user()->id)
                    ->whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'client_id', 'title', 'start', 'end', 'url']);
  
             return response()->json($data);
        }
  
        return view('calendar');
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = ReleasesCharge::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;

             case 'update':
                $event = ReleasesCharge::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
   
                return response()->json($event);
               break;
  
           case 'delete':
              $event = ReleasesCharge::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }

}
