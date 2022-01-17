<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReleaseStatus;
use App\Models\Clients;
use App\Models\Partners;
use Carbon\Carbon;

class Releases extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status_id', 'parcel', 'issue_date', 'agreement_id', 'due_date', 'type_id', 'portion', 'client_id', 'partner_id', 'amount'];

    
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

    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function clientCount()
    {
        return $this->belongsTo(Clients::class, 'client_id')->count();
    }
     
    public function partnersClient()
    {
        return $this->hasMany(PartnersClient::class, 'client_id');
    }

    public function charges()
    {
        return $this->belongsTo(ReleasesCharge::class, 'client_id');
    }

    public function type()
    {
        return $this->belongsTo(TypeReleases::class, 'type_id');
    }

    public function getdateAttribute()
    {
        $mytime = Carbon::now();

        $amount = $this->attributes['amount'];

        $amountCorrection = ($amount * 0.02) + $amount + ($mytime->diffInMonths($this->attributes['due_date']) * $amount * 0.01) ;

        if($this->attributes['status_id']=="2"){
            return $amount;
        }
        elseif($this->attributes['status_id']=="3"){
            return $amountCorrection;
        }
        else{
            return 0;
        }
    }

    public function newAmount()
    {
        $mytime = Carbon::now();
        return ($this->amount * 0.02) + $this->amount + ($mytime->diffInMonths($this->due_date) * $this->amount * 0.01) ;
    }

    public function getCpfAttribute()
    {
        return "CPF";
    }

}
