<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'complain';

    protected $fillable = [ 'user_id', 'status', 'society_id', 'created_at', 'updated_at'];

}
