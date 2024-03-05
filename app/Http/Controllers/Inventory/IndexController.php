<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return $this->OkResponse(Inventory::all(), 'inventories');
    }
}
