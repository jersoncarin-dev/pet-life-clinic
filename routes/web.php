<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ClientController;
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

Route::view('/','auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/',[AuthenticationController::class,'login'])
    ->middleware('guest')
    ->name('post-login');

Route::get('/auth',[AuthenticationController::class,'auth'])
    ->middleware('auth')
    ->name('auth');

Route::view('/register','auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register',[AuthenticationController::class,'register'])
    ->middleware('guest')
    ->name('post-register');

Route::middleware('auth')->group(function() {
    Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');
    Route::view('/about-us','clients.about')->name('about');
    Route::get('/profile',[AuthenticationController::class,'profile'])->name('profile');
    Route::post('/profile/{type?}',[AuthenticationController::class,'updateProfile'])->name('update.profile');
    Route::middleware('role:client')->as('client.')->prefix('my')->group(function() {
        Route::get('dashboard',[ClientController::class,'dashboard'])->name('dashboard');
        Route::get('products',[ClientController::class,'products'])->name('products');
        Route::get('appointments',[ClientController::class,'appointments'])->name('appointments');
        Route::post('appointments/add',[ClientController::class,'addAppointment'])->name('create.appointment');
        Route::get('pets',[ClientController::class,'pets'])->name('pets');
        Route::post('pets/add',[ClientController::class,'addPet'])->name('create.pet');
        Route::get('reminders',[ClientController::class,'reminders'])->name('reminders');
    });

});