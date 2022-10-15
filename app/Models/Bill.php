<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'bill';

    protected $fillable = [ 'user_id', 'status', 'society_id', 'created_at', 'updated_at'];

}
