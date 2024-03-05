<?php

namespace App\Http\Controllers\Rent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rent\StoreRequest;
use App\Models\EmployeeIncome;
use App\Models\IncomeSchedule;
use App\Models\Inventory;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CreateController extends Controller
{
    /**
     * Метод для добавления новых аренд
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $inventory = Inventory::find($data['inventory_id']);

        ($inventory->status == 'свободен') ?: throw new Exception('Инвентарь уже занят');

        $data['start_date'] = now();
        $data['price_day'] ?
            (($data['price_day'] = 1) && ($data['end_date'] = Carbon::parse($data['start_date'])->addDays(7)) && ($data['payment_amount'] = $inventory['price_per_day']))
            : (($data['price_day'] = 7) && ($data['end_date'] = Carbon::parse($data['start_date'])->addDay()) && ($data['payment_amount'] = $inventory['price_per_week']));
        $response = Rent::create($data);
        $data = [
            'date' => $response->created_at->format('Y-m-d'),
            'income' => $response->payment_amount
        ];

        // Найти запись по дате
        $incomeSchedule = IncomeSchedule::where('date', $data['date'])->first();

        if ($incomeSchedule) {
            // Обновить значение поля income
            $incomeSchedule->increment('income', $data['income']);
        } else {
            // Создать новую запись, если запись не найдена
            IncomeSchedule::create($data);
        }


        $data['employee_id']=$response['employee_id'];

        // Найти запись по дате
        $employeeIncome = EmployeeIncome::where('date', $data['date'])->where('employee_id', $data['employee_id'])->first();

        if ($employeeIncome) {
            // Обновить значение поля income
            $employeeIncome->increment('income', $data['income']);
        } else {
            // Создать новую запись, если запись не найдена
            EmployeeIncome::create($data);
        }


        $rent = Rent::find($response['id']);
        return $this->OkResponse($rent, 'rent');
    }
}
