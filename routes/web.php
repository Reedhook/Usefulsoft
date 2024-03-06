<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/form',function (){
    return view('index');
});
Route::get('/graphics/schedule',[App\Http\Controllers\Income\IndexController::class, 'indexSchedule'])->name('income.graphic');
Route::get('/graphics/employee',[App\Http\Controllers\Income\IndexController::class, 'indexEmployee'])->name('income.table');
