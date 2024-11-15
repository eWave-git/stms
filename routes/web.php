<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/devices', [DeviceController::class, 'index'])->name('devices');
Route::get('/widgets', [WidgetController::class, 'index'])->name('widgets');
