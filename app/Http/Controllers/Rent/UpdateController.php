<?php

namespace App\Http\Controllers\Rent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\UpdateRequest;
use App\Models\Rent;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class UpdateController extends Controller
{
    /**
     * Метод для закрытия имеющихся арендных сделок
     * @param $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update($id): JsonResponse
    {
        $rent = Rent::findOrFail($id);
        !$rent['is_finished']?:throw new Exception('Сделка уже закрыта');
        $rent->is_finished = true;

        $request = new UpdateRequest([
            'status' => false
        ]);

        App::call('App\Http\Controllers\Inventory\UpdateController@update', ['id' => $rent['inventory_id'], 'request' => $request]);
        $rent->save();
        return $this->OkResponse(Rent::find($id), 'rent');

    }
}
