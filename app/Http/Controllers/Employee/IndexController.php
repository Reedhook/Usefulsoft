<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * Метод для получения записей об инвентарях
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->OkResponse(Employee::all(), 'employees');
    }
}
