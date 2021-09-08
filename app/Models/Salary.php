<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'salary',
        'salary_date',
        'salary_month',
        'salary_year',
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }

}
