<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'events';

    public function event_image()
    {
        return $this->hasMany('App\Models\EventsImage','event_id','id');
    }

}
