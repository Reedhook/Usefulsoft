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
    Route::patch('/{inventory_id}', [App\Http\Controllers\Inventory\UpdateController::class, 'update'])->name('inventory.update');
    Route::delete('/{inventory_id}', [App\Http\Controllers\Inventory\DeleteController::class, 'delete'])->name('inventory.delete');
});
Route::get('/employees',[App\Http\Controllers\Employee\IndexController::class, 'index'])->name('employee.index');
Route::get('/clients',[App\Http\Controllers\Client\IndexController::class, 'index'])->name('client.index');

Route::group(['prefix' => 'rents'], function (){
    Route::get('/', [App\Http\Controllers\Rent\IndexController::class, 'index'])->name('rent.index');
    Route::post('/', [App\Http\Controllers\Rent\CreateController::class, 'store'])->name('rent.store');
    Route::patch('/{rent_id}', [App\Http\Controllers\Rent\UpdateController::class, 'update'])->name('rent.update');
});
