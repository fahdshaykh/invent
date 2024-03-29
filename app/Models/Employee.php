<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'salary',
        'nid',
        'joining_date',
        'photo',
    ];

    public function salaries()
    {
        return $this->belongsTo(Salary::class);
    }

}
