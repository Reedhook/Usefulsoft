<?php

namespace App\Http\Controllers\Income;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeIncome;
use App\Models\IncomeSchedule;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function indexSchedule(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
   {
       $incomes = IncomeSchedule::select('date', 'income')->get();

       return view('graphic_schedule', compact('incomes'));
   }
   public function indexEmployee(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
   {
       $employees = Employee::all();

       $query = EmployeeIncome::query();

       // Поиск по ФИО
       if ($request->filled('search')) {
           $query->whereHas('employee', function ($q) use ($request) {
               $q->where('name', 'like', '%'.$request->input('search').'%');
           });
       }

       // Фильтрация по интервалу времени (неделя, месяц)
       if ($request->filled('interval')) {
           if ($request->input('interval') == 'week') {
               $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
           } elseif ($request->input('interval') == 'month') {
               $query->whereMonth('date', Carbon::now()->month);
           }
       }

       $incomes = $query->get();

       return view('table_employee', compact('employees', 'incomes'));
   }
}
