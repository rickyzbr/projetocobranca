<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clients;
use App\Models\Partnerss;
use App\Models\ReleasesCharge;

class ReleasesCharge extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'client_id', 'partner_id', 'success', 'title', 'url', 'start', 'end' ];

    public function partner()
    {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    
}
