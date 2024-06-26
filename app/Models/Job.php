<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $fillable = [
      'job_name'
    ];
    
    public function employees()
    {
        return $this->hasMany(Employee::class, 'job_id');
    }
}
