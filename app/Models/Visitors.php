<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'visitors';

    protected $fillable = [ 'user_id', 'status', 'society_id', 'created_at', 'updated_at'];

    public function floor()
    {
        return $this->hasOne('App\Models\Floor','id','floor_no');
    }
    public function Unit()
    {
        return $this->hasOne('App\Models\Unit','id','unit_no');
    }

}
