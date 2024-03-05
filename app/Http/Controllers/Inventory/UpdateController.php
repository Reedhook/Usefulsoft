<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\UpdateRequest;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UpdateController extends Controller
{
    public function update(UpdateRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        if(isset($data['status'])){
            $data['status'] = $data['status']?'В аренде':'свободен';
        }
        $inventory = Inventory::findOrFail($id);
        $inventory->update($data);

        return $this->OkResponse(Inventory::find($id), 'inventory');

    }
}
