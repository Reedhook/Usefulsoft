<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StoreRequest;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;

class CreateController extends Controller
{
    /**
     * Метод для добавление новых инвентарей
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data =$request->validated();
        $response = Inventory::create($data);
        $inventory = Inventory::find($response['id']);
         return $this->OkResponse($inventory, 'inventory');
    }
}
