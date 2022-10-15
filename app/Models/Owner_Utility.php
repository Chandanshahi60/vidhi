<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner_Utility extends Model
{
    /**
      * The attributes that are mass assignable.
      *
      * @var array
    */
	protected $table = 'owner_utility';


    public function floor()
    {
        return $this->hasOne('App\Models\Floor','id','floor_no');
    }

    public function Unit()
    {
        return $this->hasOne('App\Models\Unit','id','unit_no');
    }
}
