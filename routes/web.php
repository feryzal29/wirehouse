<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapinguserController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TransferController;
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
    Route::get('master/plan','index')->name('master.plan.index')->middleware('role:user|administrator');
    Route::post('master/plan','store')->name('master.plan.store')->middleware('role:user|administrator');
    Route::get('master/plan/{id}/delete','destroy')->name('master.plan.delete')->middleware('role:user|administrator');
});

Route::controller(UserController::class)->group(function (){
    Route::get('master/user','index')->name('master.user.index')->middleware('role:user|administrator');
    Route::get('master/{id}/user','show')->name('master.user.show')->middleware('role:user|administrator');
    Route::post('master/user','store')->name('master.user.store')->middleware('role:user|administrator');
    Route::put('master/{user}/user','update')->name('master.user.update')->middleware('role:user|administrator');
    Route::delete('master/{user}/user', 'destroy')->name('master.user.destroy')->middleware('role:user|administrator');
});

Route::controller(MapinguserController::class)->group(function (){
    Route::get('master/maping','index')->name('master.maping.index')->middleware('role:user|administrator');
    Route::get('master/mapingadd','add')->name('master.maping.add')->middleware('role:user|administrator');
    Route::post('master/maping','store')->name('master.maping.store')->middleware('role:user|administrator');
});

Route::controller(MaterialController::class)->group(function (){
    Route::get('master/material','index')->name('master.material.index')->middleware('role:user|administrator');
    Route::post('master/material','store')->name('master.material.store')->middleware('role:user|administrator');
    Route::get('master/material/{id}/delete','destroy')->name('master.material.delete')->middleware('role:user|administrator');
    Route::get('master/material/{material}/show','show')->name('master.material.show')->middleware('role:user|administrator');
    Route::put('master/{material}/material','update')->name('master.material.update')->middleware('role:user|administrator');
});

Route::controller(TransferController::class)->group(function (){
    Route::get('transfer','index')->name('transfer.index')->middleware('role:user|administrator');
    Route::get('transfer/{id}/show','show')->name('transfer.show')->middleware('role:user|administrator');
    Route::get('transfer/{id}/penerimaan','Penerimaan')->name('transfer.penerimaan')->middleware('role:user|administrator');
    Route::get('transfer/masuk','TransferMasukGet')->name('transfer.masuk')->middleware('role:user|administrator');
    Route::get('transfer/masuk-terima','TransferMasukGetDiterima')->name('transfer.terima')->middleware('role:user|administrator');
    Route::get('transfer/post','TransferKeluarPost')->name('transfer.form')->middleware('role:user|administrator');
    Route::get('transfer/{id}/delete','destroy')->name('transfer.delete')->middleware('role:user|administrator');
    Route::post('transfer/add','store')->name('transfer.store')->middleware('role:user|administrator');
    Route::post('transfer/{transfer}/update','update')->name('transfer.update')->middleware('role:user|administrator');    
    Route::put('transfer/{transfer}/pengganti','Pengganti')->name('transfer.pengganti')->middleware('role:user|administrator'); 
});