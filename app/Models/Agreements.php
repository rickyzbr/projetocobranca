<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WGenial\NumeroPorExtenso\NumeroPorExtenso;

class Agreements extends Model
{
    use HasFactory;

    protected $guarded = ['installments'];

    protected $fillable = ['user_id', 'client_id', 'partner_id', 'agreements_amount', 'inflow_amount', 'balance_amount', 'parcel_amount', 'installments', 'issue_date', 'portion', 'due_date', 'fine'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function status()
    {
        return $this->belongsTo(ReleaseStatus::class, 'status_id');
    }

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    public function type()
    {
        return $this->belongsTo(TypeReleases::class, 'type_id');
    }

    public function releasesAgreements()
    {
        return $this->hasMany(ReleasesAgreements::class, 'agreement_id');
    }
}
