<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    /**
     * Метод для получения записей об инвентарях
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->OkResponse(Client::all(), 'clients');
    }
}
