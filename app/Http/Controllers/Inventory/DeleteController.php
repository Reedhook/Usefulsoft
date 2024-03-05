<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete($id): JsonResponse
    {
        $inventory = Inventory::find($id);
        $inventory->delete();
        return $this->deleteResponse();
    }
}
