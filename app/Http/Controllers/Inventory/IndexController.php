<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * Метод для получения записей об инвентарях
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->OkResponse(Inventory::all(), 'inventories');
    }
}
