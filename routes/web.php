<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SubsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSEController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/monitor', [SubsController::class, 'index']);
Route::post('/show-data', [SubsController::class, 'show']);

// Device
Route::get('device', [DeviceController::class, 'index'])->name('home');

// Data
Route::get('device/{id}', [DeviceController::class, 'getLastData']);
Route::get('device/{id}/ajax', [DeviceController::class, 'getLastDataAjax']);
