<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientStatus;
use App\Models\TypesSalesClient;
use App\Models\PartnersClient;
use App\Models\ContactsClient;
use Carbon\Carbon;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status_id', 'termination_id', 'sale_id', 'name', 'supervisor', 'cadeiras_ativas', 'cadeiras_capacidade',     
    'ddress', 'number', 'complement', 'address', 'cep', 'state', 'city', 'bairro', 'regiao', 
    'google_maps', 'populacao', 'cluster', 'country', 'razao_social', 'cnpj', 'cro',    
    'insc', 'responsavel_tecnico',    'responsavel_tecnico_cro', 'phone01', 'phone02', 'whatsapp',
    'site', 'email', 'email_site', 'date_initial', 'date_end', 'date_open', 'date_termination',
    'deadline_opening', 'description', 'image',
     ];

    protected $dates = ['date_initial', 'date_end'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function status()
    {
        return $this->belongsTo(ClientStatus::class, 'status_id');
    }

    public function sales()
    {
        return $this->belongsTo(TypesSalesClient::class, 'sale_id');
    }

    public function contactsClient()
    {
        return $this->hasMany(ContactsClient::class, 'client_id');
    }

    public function partnersClient()
    {
        return $this->hasMany(PartnersClient::class, 'client_id');
    }

    public function releases()
    {
        return $this->hasMany(Releases::class, 'client_id')->where('status_id', '=', 3);
    }

    public function charges()
    {
        return $this->hasMany(ReleasesCharge::class, 'client_id');
    }

    public function releaseswithuser()
    {
        return $this->hasMany(Releases::class, 'client_id')->where('assigned_to', '=', auth()->user()->id)->where('status_id', '=', 3);
    }

    public function release()
    {
        return $this->belongsTo(Releases::class, 'client_id');
    }

    public function number_of_vencs()
    {
        return $this->hasMany(Releases::class, 'client_id')->where('status_id', '=', 3)->count();
    }

    public function getnewValue() 
    {
        return $this->hasMany(Releases::class, 'client_id')->rounded('amount', '*', 0.01);
    }

    public function search(Array $data, $totalPage)
    {
        return  $this->where(function ($query) use($data) {
            if (isset($data['name']))
                $query->where('name','LIKE','%'.$data['name'].'%')
                      ->orWhere('supervisor','LIKE','%'.$data['name'].'%'); 

            if (isset($data['dados']))
                $query->where('cnpj','LIKE','%'.$data['dados'].'%')
                    ->orWhere('insc','LIKE','%'.$data['dados'].'%');
                      
            if (isset($data['status_id']))
                $query->where('status_id', $data['status_id']);
          
            if (isset($data['sale_id']))
                $query->where('sale_id', $data['sale_id']);
                
            
        })   
        ->paginate($totalPage);

        return $clients;
    }
}
