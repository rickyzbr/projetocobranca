<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Partners;
use App\Models\Clients;
use App\Models\PartnersClient;
use App\Models\Releases;

class Partners extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalClients()
    {
        return $this->hasMany(PartnersClient::class, 'client_id')->count();
    }

    public function releases()
    {
        return $this->hasMany(Releases::class, 'partner_id');
    }
}
