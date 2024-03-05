<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'inventories'], function (){
    Route::get('/', [App\Http\Controllers\Inventory\IndexController::class, 'index'])->name('inventory.index');
    Route::post('/', [App\Http\Controllers\Inventory\CreateController::class, 'store'])->name('inventory.store');
    Route::patch('/{id}', [App\Http\Controllers\Inventory\UpdateController::class, 'update'])->name('inventory.update');
    Route::delete('/{id}', [App\Http\Controllers\Inventory\DeleteController::class, 'delete'])->name('inventory.delete');
});
