<?php

namespace App\Http\Controllers\Rent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rent\StoreRequest;
use App\Models\Inventory;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
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

        ($inventory->status =='свободен')?:throw new Exception('Инвентарь уже занят');

        $data['start_date'] = now();
        $data['price_day'] ?
            (($data['price_day'] = 1) && ($data['end_date'] = Carbon::parse($data['start_date'])->addDays(7))&&($data['payment_amount'] = $inventory['price_per_day']))
            : (($data['price_day'] = 7) && ($data['end_date'] = Carbon::parse($data['start_date'])->addDay())&&($data['payment_amount'] = $inventory['price_per_week']));
        $response = Rent::create($data);
        $rent = Rent::find($response['id']);
        return $this->OkResponse($rent, 'rent');
    }
}
