<?php

use App\Action\Notification;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagementController;
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

Route::get('/test',function() {
    Notification::send([
        'title' => 'Fuck you',
        'body' => 'Fuck you body',
        'link' => 'current',
        'is_read' => true,
        'notif_bound_time' => now()->diffForHumans()
    ],[1]);
});

Route::middleware('auth')->group(function() {
    Route::post('/notif/read',[AuthenticationController::class,'readNotif'])->name('notif.read');
    Route::get('/auth-token',[AuthenticationController::class,'token'])->name('auth.token');
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

    Route::middleware('role:admin,staff')->as('staff.')->prefix('manage')->group(function() {
        Route::get('profile',[AuthenticationController::class,'profileStaff'])->name('profile');

        Route::get('dashboard',[ManagementController::class,'dashboard'])->name('dashboard');

        Route::get('appointments',[ManagementController::class,'appointments'])->name('appointments');
        Route::post('appointments/approve',[ManagementController::class,'approveAppointments'])
            ->name('appointment.approve');

        Route::get('appointments/list',[ManagementController::class,'listAppointments'])->name('appointments.list');
        Route::post('appointments/add/note',[ManagementController::class,'addNoteAppointments'])->name('appointments.note');

        Route::get('products',[ManagementController::class,'products'])->name('products');
        Route::post('products/add',[ManagementController::class,'addProduct'])->name('product.add');
        Route::post('products/edit',[ManagementController::class,'editProduct'])->name('product.edit');

        Route::get('notification',[ManagementController::class,'notification'])->name('notification');

        Route::get('reminders',[ManagementController::class,'reminders'])->name('reminders');
        Route::post('reminders/send',[ManagementController::class,'sendReminder'])->name('send.reminder');

        Route::get('pets',[ManagementController::class,'pets'])->name('pets');

        Route::get('clients',[ManagementController::class,'clients'])->name('clients');
        Route::get('admins',[ManagementController::class,'admins'])->name('admins');
        Route::get('staffs',[ManagementController::class,'staffs'])->name('staffs');

        Route::get('user/delete',[ManagementController::class,'deleteUser'])->name('user.delete');
        Route::post('user/add',[ManagementController::class,'addUser'])->name('user.add');
        Route::post('user/edit',[ManagementController::class,'editUser'])->name('user.edit');

        Route::get('reports',[ManagementController::class,'reports'])->name('reports');
    });

});