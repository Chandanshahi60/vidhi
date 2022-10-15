<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Owner extends Authenticatable implements JWTSubject
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

protected $table = 'owner';

  public function committe_details(){
    return $this->hasOne('App\Models\Managementcommittee','owner_id','id');
  }

  public function nominee_details(){
    return $this->hasMany('App\Models\Nomination_detail','owner_id','id');
  }

  public function parking_details(){
    return $this->hasMany('App\Models\SocietyParking','owner_id','id');
  }

  public function family_details(){
    return $this->hasMany('App\Models\SocietyFamily','owner_id','id');
  }

  public function user(){
    return $this->hasOne('App\Models\User','id','user_id');
  }

  public function unit(){
    return $this->hasMany('App\Models\Unit','id','owner_unit');
  }


}
