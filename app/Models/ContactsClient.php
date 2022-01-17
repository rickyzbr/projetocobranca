<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cargo;

class ContactsClient extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Clients::class);
        
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
        
    }
    
}
