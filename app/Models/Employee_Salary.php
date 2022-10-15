<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee_Salary extends Model
{
    /**
      * The attributes that are mass assignable.
      *
      * @var array
    */
	protected $table = 'employee_salary';

    public function employee()
    {
        return $this->hasOne('App\Models\Employee','id','name');
    }

}
