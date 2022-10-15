<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'unit';

    protected $fillable = [ 'user_id', 'status', 'society_id', 'unit_no', 'floor_no', 'created_at', 'updated_at'];

    public function floor()
    {
        return $this->hasOne('App\Models\Floor','id','floor_no');
    }

}
