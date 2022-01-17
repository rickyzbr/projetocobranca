<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
