<?php

namespace App\Http\Controllers\Rent;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * Метод для получение записей о арендах
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->OkResponse(Rent::all(), 'rents');
    }
}
