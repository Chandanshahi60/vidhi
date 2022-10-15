<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */

    protected $table = 'floor';
    
    protected $fillable = [ 'user_id', 'status', 'society_id', 'title', 'created_at', 'updated_at'];

}
