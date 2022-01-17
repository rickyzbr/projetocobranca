<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeHistorics extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'client_id', 'partner_id', 'name', 'phone', 'description', 'date'];

    public function partner()
    {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    public function client()
    {
        return $this->belongsTo(Clients::class, 'partner_id');
    }
}
