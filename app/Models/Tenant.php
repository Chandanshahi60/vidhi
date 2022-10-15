<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Tenant extends Authenticatable implements JWTSubject
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
    protected $table = 'tenant';

    public function floor()
    {
        return $this->hasOne('App\Models\Floor','id','floor_no');
    }
    public function Unit()
    {
        return $this->hasOne('App\Models\Unit','id','unit_no');
    }

    public function tenent_members_details(){
        return $this->hasOne('App\Models\TenentMembers','tenent_id','id')->with('family_details');
    }

    public function family_details(){
        return $this->hasMany('App\Models\TenentFamily','tenent_id','id');
    }

    public function parking_details(){
        return $this->hasMany('App\Models\TenantParking','tenant_id','id');
    }

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
      }
}
