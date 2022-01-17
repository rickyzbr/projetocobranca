<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clients;
use App\Models\User;
use App\Models\Partners;

class PartnersClient extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partners::class);
    }

    public function getTotalClients()
    {
        return $this->belongsTo(Clients::class, 'client_id')->count();
    }

}
