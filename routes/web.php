<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\TechnicianPageController;
use App\Http\Controllers\DriverPageController;
use App\Http\Controllers\ChooseRoleController;
use App\Http\Controllers\SuperAdminPageController;
use App\Http\Controllers\AccountPageController;
use App\Http\Controllers\AccountMappingController;
use App\Http\Controllers\TruckRouteController;
use App\Http\Controllers\DeploymentController;








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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/loginx', function () {
//     return view('loginx');
// });

// Route::get('/registerx', function () {
//     return view('registerx');
// });


// Get Routes

Route::get('/', [ChooseRoleController::class, 'choose'])->name('choose');

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

    Route::get('/deployments', [AdminPageController::class, 'deployments'])->name('admin.deployments');

    Route::get('/deployment/{deployment_id}', [AdminPageController::class, 'deployment'])->name('admin.deployment');

    Route::get('/truck_routes', [AdminPageController::class, 'truck_routes'])->name('admin.truck_routes');

    Route::get('/create_truck_route', [AdminPageController::class, 'create_truck_route'])->name('admin.create_truck_route');

});

// Technicians

Route::group(['middleware' => ['auth'],  'prefix' => 'technician'], function(){

    Route::get('/', [TechnicianPageController::class, 'index'])->name('technician');

    Route::get('/notifications', [TechnicianPageController::class, 'notifications'])->name('technician.notifications');

    Route::get('/reports', [TechnicianPageController::class, 'reports'])->name('technician.report');



});

Route::group(['middleware' => ['auth'],  'prefix' => 'superadmin'], function(){

    Route::get('/', [SuperAdminPageController::class, 'index'])->name('superadmin');

    Route::get('/notifications', [SuperAdminPageController::class, 'notifications'])->name('superadmin.notifications');

    Route::get('/staff_records', [SuperAdminPageController::class, 'staff_records'])->name('superadmin.staff_records');

    Route::get('/staff_record/{user_id}', [SuperAdminPageController::class, 'staff_record'])->name('superadmin.staff_record');

    Route::get('/create_staff', [SuperAdminPageController::class, 'create_staff'])->name('superadmin.create_staff');

    Route::get('/deployments', [SuperAdminPageController::class, 'deployments'])->name('superadmin.deployments');

    Route::get('/deployment', [SuperAdminPageController::class, 'deployment'])->name('superadmin.deployment');

    Route::get('/create_deployment', [SuperAdminPageController::class, 'create_deployment'])->name('superadmin.create_deployment');

    Route::get('/projects', [SuperAdminPageController::class, 'projects'])->name('superadmin.projects');

    Route::get('/inventories', [SuperAdminPageController::class, 'inventories'])->name('superadmin.inventories');

    Route::get('/messages', [SuperAdminPageController::class, 'messages'])->name('superadmin.messages');

    Route::get('/truck_routes', [SuperAdminPageController::class, 'truck_routes'])->name('superadmin.truck_routes');

    Route::get('/create_truck_route', [SuperAdminPageController::class, 'create_truck_route'])->name('superadmin.create_truck_route');

    Route::get('/reports', [SuperAdminPageController::class, 'reports'])->name('superadmin.report');



});



// Accounts

Route::group(['middleware' => ['auth'],  'prefix' => 'accounts'], function(){

    Route::get('/', [AccountPageController::class, 'index'])->name('accounts');

    Route::get('/notifications', [AccountPageController::class, 'notifications'])->name('accounts.notifications');

    Route::get('/coaccount', [AccountPageController::class, 'coaccount'])->name('accounts.coaccounts');

    Route::get('/vouchers', [AccountPageController::class, 'vouchers'])->name('accounts.vouchers');

    Route::get('/reports', [AccountPageController::class, 'index'])->name('accounts.reports');



});


// Drivers

Route::group(['middleware' => ['auth'],  'prefix' => 'driver'], function(){

    Route::get('/', [DriverPageController::class, 'index'])->name('driver');

    Route::get('/notifications', [DriverPageController::class, 'notifications'])->name('driver.notifications');

    Route::get('/messages', [DriverPageController::class, 'messages'])->name('driver.messages');

    Route::get('/profile', [DriverPageController::class, 'profile'])->name('driver.profile');

    Route::get('/deployments', [DriverPageController::class, 'deployments'])->name('driver.deployments');

    Route::get('/projects', [DriverPageController::class, 'projects'])->name('driver.projects');

    Route::get('/deployment/{deployment_id}', [DriverPageController::class, 'deployment'])->name('driver.deployment');

    Route::get('/truck_routes', [DriverPageController::class, 'truck_routes'])->name('driver.truck_routes');

    Route::get('/reports', [DriverPageController::class, 'reports'])->name('driver.reports');


});


Route::group(['middleware' => ['auth'],  'prefix' => 'secretary'], function(){

    Route::get('/', [SecretaryPageController::class, 'index'])->name('secretary');

    Route::get('/notifications', [SecretaryPageController::class, 'notifications'])->name('secretary.notifications');

    Route::get('/reports', [SecretaryPageController::class, 'index'])->name('secretary.reports');



});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// all post

Route::post('/map_account', [AccountMappingController::class, 'map_account'])->name('map_account');

Route::post('/create_truck_route', [TruckRouteController::class, 'create_truck_route'])->name('create_truck_route');




// all get


Route::post('/account_maps', [AccountMappingController::class, 'accounts_map'])->name('accounts_map');

Route::post('/create_deployment_zone', [DeploymentController::class, 'create_deployment_zone'])->name('create_deployment_zone');




