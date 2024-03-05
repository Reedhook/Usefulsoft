<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\UpdateRequest;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    public function update(UpdateRequest $request, $id): JsonResponse
    {
        $data = $request->all();
        if(isset($data['status'])){
            $data['status'] = $data['status']?'свободен':'В аренде';
        }
        $inventory = Inventory::findOrFail($id);
        $inventory->update($data);

        return $this->OkResponse(Inventory::find($id), 'inventory');

    }
}
