<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Clients;
use App\Models\PartnersClient;
use App\Models\Partners;
use DB;

class PartnersController extends Controller

{

    private $partners;
    private $totalPage = 15;
    private $path = 'partners';  

    function __construct(Partners $partner, Clients $client)
    {
        $this->partner = $partner;
        $this->client = $client;
    }  

    public function index( $id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }
        $totalClients = Clients::count();
        return view ('clients.partners', compact('client', 'totalClients')); 
    }

    public function store(Request $request)
    {
        
        DB::beginTransaction();

        $dataForm = $request->except('_token');
        
        $insert = auth()->user()->contactsClients()->create($dataForm);
                
        if ($insert){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'O Contato foi cadastrado com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function update(Request $request, $id)
    {
        $contact = $this->contact_client->find($id);
        $dataForm = $request->except('_token');

               
        $update = $contact->update($dataForm);
                
        if ($update){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'O Cidade selecionada foi atualizada com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }

    }

    public function destroy($id)
    {
        $contact = $this->contact_client->find($id);
        
        $delete = $contact->delete();
        
        if ($delete){

            DB::commit();
        
            return redirect()
                        ->back()
                        ->with('success', 'O Sócio foi deletado com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }
    }

    public function list(Partners $partner)
    {
        //$banners = auth()->user()->bannerCreate()->paginate($this->totalPage);
        $partners = $this->partner->paginate($this->totalPage);
        $totalPartners = Partners::count();
        return view('partners.index', compact ('partners', 'totalPartners'));   
    }
}
