<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapinguserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;


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

// Route::get('/', function () {
//     return view('index');
// });

Route::controller(LoginController::class)->group(function (){
    Route::get('login','index')->name('login.index');
    Route::post('login','store')->name('login.store');
    Route::get('logout','logout')->name('logout');
});

Route::controller(IndexController::class)->group(function (){
    Route::get('/','index')->name('index')->middleware('role:user|administrator');
});

Route::controller(PlanController::class)->group(function (){
    Route::get('master/plan','index')->name('master.plan.index');
    Route::post('master/plan','store')->name('master.plan.store');
    Route::get('master/plan/{id}/delete','destroy')->name('master.plan.delete');
});

Route::controller(UserController::class)->group(function (){
    Route::get('master/user','index')->name('master.user.index');
    Route::get('master/{id}/user','show')->name('master.user.show');
    Route::post('master/user','store')->name('master.user.store');
    Route::put('master/{user}/user','update')->name('master.user.update');
    Route::delete('master/{user}/user', 'destroy')->name('master.user.destroy');
});

Route::controller(MapinguserController::class)->group(function (){
    Route::get('master/maping','index')->name('master.maping.index');
    Route::get('master/mapingadd','add')->name('master.maping.add');
    Route::post('master/maping','store')->name('master.maping.store');
});