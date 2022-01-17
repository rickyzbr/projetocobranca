<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Clients;
use App\Models\Releases;
use App\Models\ReleasesCharge;
use App\Models\ChargeHistorics;
use App\Models\Agreements;
use App\Models\ReleasesAgreements;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function clients()
    {
        return $this->hasMany(Clients::class);
    }

    public function categories()
    {
        return $this->hasMany(Categories::class);
    }

    public function release()
    {
        return $this->hasMany(Releases::class);
    }

    public function schedule()
    {
        return $this->hasMany(ReleasesCharge::class);
    }

    public function charge()
    {
        return $this->hasMany(ChargeHistorics::class);
    }

    public function agreements()
    {
        return $this->hasMany(Agreements::class);
    }

    public function releasesofagreements()
    {
        return $this->hasMany(ReleasesAgreements::class);
    }

}
