<?php

namespace App\Models;
use App\Models\Employee;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salaries';
    protected $fillable = [
      'emp_id','job_id','salary','ratio'
    ];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
    
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
    /*
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
    */
}
