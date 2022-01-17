<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use files;
use App\Models\User;
use App\Models\Clients;
use App\Models\ClientStatus;
use App\Models\TypesSalesClient;
use App\Models\TypesTerminationClient;
use App\Models\AttachmentsClients;
use App\Models\Cargo;
use App\Models\Releases;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class ClientsController extends Controller
{
    private $clients;
    private $totalPage = 15;
    private $path = 'clients';   

    public function __construct(AttachmentsClients $AttachmentsClients, Clients $clients)
    {
        $this->AttachmentsClients = $AttachmentsClients;
        $this->clients = $clients;
    }  

    public function index(Clients $clients)
    {
        //$banners = auth()->user()->bannerCreate()->paginate($this->totalPage);
        $clients = $this->clients->paginate($this->totalPage);
        $totalClients = Clients::count();
        $cargos = Cargo::all();
        $statuses = ClientStatus::all();
        $typeSales = TypesSalesClient::all();
        $countReleases = Releases::where('status_id', 3)->count();
        return view('clients.index', compact ('clients', 'totalClients', 'typeSales', 'cargos', 'statuses', 'countReleases'));   
    }

    public function create()
    {
        $totalClients = Clients::count();
        $statuses = ClientStatus::all();
        $typeSales = TypesSalesClient::all();
        $typeTerminations = TypesTerminationClient::all();
        return view ('clients.create', compact ('totalClients', 'statuses', 'typeSales', 'typeTerminations'));
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

        $insert = auth()->user()->clients()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->route ('clients.index')
                        ->with('success', 'O Novo Cliente foi Adicionado com Sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function edit($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }
        $totalClients = Clients::count();
        $statuses = ClientStatus::all();
        $typeSales = TypesSalesClient::all();
        $typeTerminations = TypesTerminationClient::all();
        return view ('clients.edit', compact('client', 'totalClients', 'statuses', 'typeSales', 'typeTerminations'));      
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

    public function show($id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }
        $statuses = ClientStatus::all();
        $typeSales = TypesSalesClient::all();
    
        
        return view ('clients.view', compact('client', 'statuses', 'typeSales'));      
    }

    public function destroy($id)
    {
        if (!$client = Clients::find($id))
            return redirect()->route('clients.index');

        $client->delete();
        
        return redirect()->route('clients.index')->with('success', 'O Cliente foi Deletado com sucesso ! ');
    }

    public function uploadFiles($id, Request $request)
    {

            
        //$client = $this->clients->find($id);
        $client  = $this->clients->find($id); 

        //        image upload
        $image=$request->file('file');

        if($image){
            $imageName=time(). $image->getClientOriginalName();
            $image->move('images',$imageName);
            $imagePath = "$imageName";

            $client->files()->create(['image_path'=>$imagePath]);
        }

        return "done";
        // Product::create($formInput);
    }
    

    public function searchClient (Request $request, Clients $client)
    {
        
        $totalClients = Clients::count();
        $cargos = Cargo::all();
        $statuses = ClientStatus::all();
        $typeSales = TypesSalesClient::all();
        $dataForm = $request->except('_token');
        $clients = $client->search($dataForm, $this->totalPage);

        return view('clients.search', compact('clients', 'totalClients', 'cargos', 'statuses', 'typeSales', 'dataForm'));
    }

}

