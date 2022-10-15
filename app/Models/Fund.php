<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'fund';

    protected $fillable = [ 'user_id', 'status', 'society_id', 'created_at', 'updated_at'];

    public function owner()
    {
        return $this->hasOne('App\Models\Owner','id','owner_name');
    }

}
