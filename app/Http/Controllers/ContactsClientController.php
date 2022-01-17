<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Clients;
use App\Models\Cargo;
use App\Models\ContactsClient;
use DB;

class ContactsClientController extends Controller
{
    function __construct(ContactsClient $contact_client, Clients $client)
    {
        $this->contact_client = $contact_client;
        $this->client = $client;
    }  

    public function index( $id)
    {
        if (!$client = Clients::find($id)){
            return redirect()->back();
        }
        $cargos = Cargo::get();
        $totalClients = Clients::count();
        return view ('clients.contacts', compact('client', 'totalClients', 'cargos')); 
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
                        ->with('success', 'O Contato foi deletado com sucesso ! ');

        } else {

            DB::rollback();

            return redirect()
                        ->back()
                        ->with('error', 'Ops, Deu algum erro' );
        }
    }
}
