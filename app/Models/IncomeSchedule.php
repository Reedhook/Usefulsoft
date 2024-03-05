<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeSchedule extends Model
{
    use HasFactory;
    protected $table='incomes_schedules';
    protected $guarded = false;
}
