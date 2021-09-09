<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\TechnicianPageController;
use App\Http\Controllers\DriverPageController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/loginx', function () {
    return view('loginx');
});

Route::get('/registerx', function () {
    return view('registerx');
});


// Get Routes

Route::get('/choose', [ChooseRoleController::class, 'choose'])->name('choose');

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('auth/{provider}', [SocialiteController::class, 'redirectToProvider']);

Route::get('auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);



// Admin

Route::group(['middleware' => ['auth'],  'prefix' => 'admin'], function(){

    Route::get('/', [AdminPageController::class, 'index'])->name('admin');

    Route::get('/notifications', [AdminPageController::class, 'notifications'])->name('admin.notifications');

    Route::get('/inventories', [AdminPageController::class, 'inventories'])->name('admin.inventories');

    Route::get('/inventory/{order_id}', [AdminPageController::class, 'inventory'])->name('admin.inventory');

    Route::get('/messages', [AdminPageController::class, 'messages'])->name('admin.messages');

    Route::get('/orders', [AdminPageController::class, 'orders'])->name('admin.orders');

    Route::get('/order/{order_id}', [AdminPageController::class, 'order'])->name('admin.order');

    Route::get('/orders', [AdminPageController::class, 'orders'])->name('admin.orders');

    Route::get('/reports', [AdminPageController::class, 'reports'])->name('admin.reports');

    Route::get('/report/{report_id}', [AdminPageController::class, 'report'])->name('admin.report');

    Route::get('/staff_records', [AdminPageController::class, 'staff_records'])->name('admin.staff_records');

    Route::get('/staff_record/{staff_id}', [AdminPageController::class, 'staff_record'])->name('admin.staff_record');

    Route::get('/projects', [AdminPageController::class, 'projects'])->name('admin.projects');

    Route::get('/project/{project_id}', [AdminPageController::class, 'project'])->name('admin.project');

    Route::get('/profile', [AdminPageController::class, 'profile'])->name('admin.profile');

});

// Technicians

Route::group(['middleware' => ['auth'],  'prefix' => 'technician'], function(){

    Route::get('/', [TechnicianPageController::class, 'index'])->name('technician');

    Route::get('/notifications', [TechnicianPageController::class, 'notifications'])->name('technician.notifications');

    Route::get('/reports', [TechnicianPageController::class, 'reports'])->name('technician.report');



});


// Drivers

Route::group(['middleware' => ['auth'],  'prefix' => 'driver'], function(){

    Route::get('/', [DriverPageController::class, 'index'])->name('driver');

    Route::get('/notifications', [DriverPageController::class, 'notifications'])->name('driver.notifications');

    Route::get('/reports', [DriverPageController::class, 'reports'])->name('driver.reports');



});


Route::group(['middleware' => ['auth'],  'prefix' => 'secretary'], function(){

    Route::get('/', [SecretaryPageController::class, 'index'])->name('secretary');

    Route::get('/notifications', [SecretaryPageController::class, 'notifications'])->name('secretary.notifications');

    Route::get('/reports', [SecretaryPageController::class, 'index'])->name('secretary.reports');



});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
