<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'meeting';

    protected $fillable = [ 'user_id', 'status', 'society_id', 'created_at', 'updated_at'];

}
