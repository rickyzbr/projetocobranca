<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Releases;

class ReleasesAgreements extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'client_id', 'release_id', 'agreement_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function release()
    {
        return $this->belongsTo(Releases::class);
    }
}
