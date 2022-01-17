<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clients;
use App\Models\Releases;
use App\Models\ReleaseStatus;
use App\Models\MonthReleases;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class ReleasesController extends Controller
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
        //$banners = auth()->user()->bannerCreate()->paginate($this->totalPage);
        $releases = $this->releases->paginate($this->totalPage);
        $statuses = ReleaseStatus::all();
        $months = MonthReleases::all();
        $users = User::all();
        $clients = Clients::all();


        return view('releases.index', compact ('releases', 'statuses', 'months', 'clients', 'users'));   
    }

    public function update_status(Request $request)
    {
        if ($request->ajax()){
            if (!empty($request->checkbox)) {            

                foreach ($request->checkbox as $checkbox) {
                    $releases                = Releases::find($checkbox);
                    $releases->status_id     = $request->status;
                    $releases->amount        = $request->amount;
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

    public function create()
    {
        $statuses = ReleaseStatus::all();
        $months = MonthReleases::all();
        $users = User::all();
        $clients = Clients::all();
        return view ('releases.create', compact ('statuses', 'months', 'clients', 'users'));
    }

    public function store(Request $request)
    {
        
        DB::beginTransaction();

        $dataForm = $request->except('_token');

        // Verifica se informou a imagem para upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

        // Define finalmente o nome
        $nameFile = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
       

        // Faz o upload:
        $upload = $request->image->storeAs($this->path, $nameFile);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        $dataForm['image'] = $upload;
        // Verifica se NÃO deu certo o upload
        if (!$upload)
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer o upload da imagem');


        }

        $insert = auth()->user()->release()->create($dataForm);
                
        if ($insert){

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

    public function update(Request $request, $id)
    {
        
        if (!$client = Clients::find($id))
            return redirect()->route('clients.index');
       
        $dataForm = $request->except('_token');
        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;

       // Verifica se informou a imagem para upload
       // Verifica se informou a imagem para upload
       if ($request->hasFile('image') && $request->file('image')->isValid()) {

        // Define finalmente o nome
        $nameFile = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
       

        // Faz o upload:
        $upload = $request->image->storeAs($this->path, $nameFile);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        $dataForm['image'] = $upload;
        // Verifica se NÃO deu certo o upload
        if (!$upload)
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer o upload da imagem');
       }


        $update = $client->update($dataForm);
                
        if ($update){

            DB::commit();
        
            return redirect()
                        ->route ('clients.index')
                        ->with('success', 'O Produto foi atualizado com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }
    
}
