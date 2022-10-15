<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses_record extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'expenses_record';

    public function vendor()
    {
        return $this->hasOne('App\Models\Vendor','id','vendor');
    }
}
