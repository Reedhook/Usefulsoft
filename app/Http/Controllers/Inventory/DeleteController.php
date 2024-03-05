<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;

class DeleteController extends Controller
{
    /**
     * Метод для удаления инвентаря
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $inventory = Inventory::find($id);
        $inventory->delete();
        return $this->deleteResponse();
    }
}
