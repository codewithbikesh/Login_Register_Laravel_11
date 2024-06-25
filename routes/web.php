<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\LoginController As AdminLoginController; 
use App\Http\Controllers\admin\DashboardController As AdminDashboardController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'account'] , function(){
 
    Route::group(['middleware' =>'guest'], function(){
        Route::get('login', [LoginController::class,'index'])->name('account.login');
        Route::get('register', [LoginController::class,'register'])->name('account.register');
        Route::post('authenticate', [LoginController::class,'authenticate'])->name('account.authenticate');
        Route::post('process-register', [LoginController::class,'processRegister'])->name('account.processRegister');
    });

    Route::group(['middleware' => 'auth'], function(){
        Route::get('logout', [LoginController::class,'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class,'dashboard'])->name('account.dashboard');
    });
});

// For admin login page routes 
// For admin login page routes 

Route::group(['prefix' => 'admin'], function(){

Route::group(['middleware' => 'admin.guest'], function(){
Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
Route::post('authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
});

Route::group(['middleware'=> 'admin.auth'], function(){
Route::get('dashboard',[AdminDashboardController::class,'dashboard'])->name('admin.dashboard');
Route::get('logout', [AdminLoginController::class,'logout'])->name('admin.logout');
});

});

