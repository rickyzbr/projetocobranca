<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Releases;
use App\Models\Clients;

class TypeReleases extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function releases()
    {
        return $this->hasMany(Releases::class, 'type_id');
    }

    public function releaseswithuser_2()
    {
        return $this->hasMany(Releases::class, 'type_id')->where('status_id', '=', 3)->where('assigned_to', '=', auth()->user()->id);        
    }

    public function releaseswithuser()
    {
        return $this->hasMany(Releases::class, 'type_id')
                        ->where(function ($query) {
                            if (auth()->check()) {
                                $query->where('assigned_to', '=', auth()->user()->id)
                                      ->where('status_id', '=', 3);
                            }
                        });
    }

    public function sumAmount()
    {
        return $this->hasMany(Releases::class, 'type_id')->sum('amount');
    }

}
