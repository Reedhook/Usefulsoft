<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeIncome extends Model
{
    use HasFactory;
    protected $table='employees_incomes';
    protected $guarded = false;
    public function employee()

    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
