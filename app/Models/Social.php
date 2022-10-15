<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'social';
    
     public function social_images(){
        return $this->hasMany('App\Models\Social_images','social_id','id');
      }

}
