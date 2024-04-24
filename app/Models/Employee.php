<?php

namespace App\Models;

use App\Models\Salary;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
      'emp_name','job_id'
    ];
    
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
    
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'emp_id');
    }
    /*
    public function salaries()
    {
        return $this->hasMany('App\Models\Salary');
    }
    
    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }
    */
}
