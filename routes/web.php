<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\ChooseRoleController;
use App\Http\Controllers\DeploymentController;
use App\Http\Controllers\DriverPageController;
use App\Http\Controllers\TruckRouteController;
use App\Http\Controllers\AccountPageController;
use App\Http\Controllers\CashRequestController;
use App\Http\Controllers\FilemanagerController;
use App\Http\Controllers\InvoiceLineController;
use App\Http\Controllers\ReportImageController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\StaffRecordController;
use App\Http\Controllers\ClientProjectController;
use App\Http\Controllers\SecretaryPageController;
use App\Http\Controllers\AccountMappingController;
use App\Http\Controllers\SuperAdminPageController;
use App\Http\Controllers\TechnicianPageController;
use App\Http\Controllers\MilestoneReportController;
use App\Http\Controllers\DeploymentReportController;
use App\Http\Controllers\ProjectMilestoneController;
use App\Http\Controllers\InstallationScheduleController;

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

Route::group(['middleware' => ['auth'],  'prefix' => 'admin'], function () {

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

    Route::get('/installation_schedule', [AdminPageController::class, 'installation_schedule'])->name('admin.installation_schedule');

    Route::get('/create_truck_route', [AdminPageController::class, 'create_truck_route'])->name('admin.create_truck_route');
});

// Technicians

Route::group(['middleware' => ['auth'],  'prefix' => 'technician'], function () {

    Route::get('/', [TechnicianPageController::class, 'index'])->name('technician');

    Route::get('/notifications', [TechnicianPageController::class, 'notifications'])->name('technician.notifications');

    Route::get('/reports', [TechnicianPageController::class, 'reports'])->name('technician.report');

    Route::get('/create_report', [TechnicianPageController::class, 'create_report'])->name('technician.create_report');
});

Route::group(['middleware' => ['auth'],  'prefix' => 'superadmin'], function () {

    Route::get('/', [SuperAdminPageController::class, 'index'])->name('superadmin');

    Route::get('/spo_reports', [SuperAdminPageController::class, 'spo_reports'])->name('superadmin.spo_reports');

    Route::get('/notifications', [SuperAdminPageController::class, 'notifications'])->name('superadmin.notifications');

    Route::get('/staff_records', [SuperAdminPageController::class, 'staff_records'])->name('superadmin.staff_records');

    Route::get('/staff_record/{user_id}', [SuperAdminPageController::class, 'staff_record'])->name('superadmin.staff_record');

    Route::get('/create_staff', [SuperAdminPageController::class, 'create_staff'])->name('superadmin.create_staff');

    Route::get('/customer', [SuperAdminPageController::class, 'customer'])->name('superadmin.customer');

    Route::get('/cash_request', [SuperAdminPageController::class, 'cash_request'])->name('superadmin.cash_request');

    Route::get('/cash_request_details/{id}', [SuperAdminPageController::class, 'cash_request_details'])->name('cash_request_details');

    Route::get('/deployments', [SuperAdminPageController::class, 'deployments'])->name('superadmin.deployments');

    Route::get('/deployment', [SuperAdminPageController::class, 'deployment'])->name('superadmin.deployment');

    Route::get('/pos', [SuperAdminPageController::class, 'pos'])->name('superadmin.pos');

    Route::get('/create_deployment', [SuperAdminPageController::class, 'create_deployment'])->name('superadmin.create_deployment');

    Route::get('/projects', [SuperAdminPageController::class, 'projects'])->name('superadmin.projects');

    Route::get('/inventories', [SuperAdminPageController::class, 'inventories'])->name('superadmin.inventories');

    Route::get('/messages', [SuperAdminPageController::class, 'messages'])->name('superadmin.messages');

    Route::get('/truck_routes', [SuperAdminPageController::class, 'truck_routes'])->name('superadmin.truck_routes');

    Route::get('/installation_schedule', [SuperAdminPageController::class, 'installation_schedule'])->name('superadmin.installation_schedule');

    Route::get('/create_installation_schedule', [SuperAdminPageController::class, 'create_installation_schedule'])->name('superadmin.create_installation_schedule');

    Route::get('/create_truck_route', [SuperAdminPageController::class, 'create_truck_route'])->name('superadmin.create_truck_route');

    Route::get('/reports', [SuperAdminPageController::class, 'reports'])->name('superadmin.report');

    Route::get('/create_report', [SuperAdminPageController::class, 'create_report'])->name('superadmin.create_report');
});

// Accounts

Route::group(['middleware' => ['auth'],  'prefix' => 'accounts'], function () {


    Route::get('/{page_name}', [AccountPageController::class, 'index']);

    Route::get('/{page_name}/{id}', [AccountPageController::class, 'details']);
});

// Drivers

Route::group(['middleware' => ['auth'],  'prefix' => 'driver'], function () {

    Route::get('/', [DriverPageController::class, 'index'])->name('driver');

    Route::get('/notifications', [DriverPageController::class, 'notifications'])->name('driver.notifications');

    Route::get('/messages', [DriverPageController::class, 'messages'])->name('driver.messages');

    Route::get('/profile', [DriverPageController::class, 'profile'])->name('driver.profile');

    Route::get('/deployments', [DriverPageController::class, 'deployments'])->name('driver.deployments');

    Route::get('/projects', [DriverPageController::class, 'projects'])->name('driver.projects');

    Route::get('/project/{project_id}', [DriverPageController::class, 'project'])->name('driver.project');

    Route::get('/deployment/{deployment_id}', [DriverPageController::class, 'deployment'])->name('driver.deployment');

    Route::get('/truck_routes', [DriverPageController::class, 'truck_routes'])->name('driver.truck_routes');

    Route::get('/reports', [DriverPageController::class, 'reports'])->name('driver.reports');

    Route::get('/create_report', [DriverPageController::class, 'create_report'])->name('driver.create_report');

    Route::get('/report/{report_id}', [DriverPageController::class, 'report'])->name('driver.report');
});


Route::group(['middleware' => ['auth'],  'prefix' => 'secretary'], function () {

    Route::get('/', [SecretaryPageController::class, 'index'])->name('secretary');

    Route::get('/notifications', [SecretaryPageController::class, 'notifications'])->name('secretary.notifications');

    Route::get('/reports', [SecretaryPageController::class, 'index'])->name('secretary.reports');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// all post

Route::group(['middleware' => ['auth']], function () {

    Route::post('/map_account', [AccountMappingController::class, 'map_account'])->name('map_account');

    Route::post('/send_message', [MessageController::class, 'send_message'])->name('send_message');

    Route::post('/create_truck_route', [TruckRouteController::class, 'create_truck_route'])->name('create_truck_route');

    Route::post('/create_installation_schedule', [InstallationScheduleController::class, 'create_installation_schedule'])->name('create_installation_schedule');

    Route::post('/create_staff_account', [StaffRecordController::class, 'create_staff_account'])->name('create_staff_account');

    Route::post('/create_report', [DeploymentReportController::class, 'create_report'])->name('create_report');

    Route::post('/update_report', [DeploymentReportController::class, 'update_report'])->name('update_report');

    Route::post('/account_maps', [AccountMappingController::class, 'accounts_map'])->name('accounts_map');

    Route::post('/create_deployment_zone', [DeploymentController::class, 'create_deployment_zone'])->name('create_deployment_zone');

    Route::post('/upload_pix', [ReportImageController::class, 'store'])->name('upload_pix');

    Route::post('/upload_pixx', [ReportImageController::class, 'update'])->name('upload_pixx');

    Route::post('/delete_pix', [ReportImageController::class, 'delete'])->name('delete.upload_pix');
});

// all get

Route::get('/media', [FilemanagerController::class, 'media'])->name('media');
Route::post('/removeMedia', [FilemanagerController::class, 'removeMedia'])->name('media.delete');


Route::get('/media/category/{id}', [FilemanagerController::class, 'mediaCategory'])->name('media.category');


Route::post('/upload-media', [FilemanagerController::class, 'uploadMedia'])->name('upload-media');

Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('update-product');


Route::post('/create-product', [ProductController::class, 'create_product']);


Route::get('/get_images', [ReportImageController::class, 'get_images'])->name('get_images');

Route::get('/get_imagesx', [ReportImageController::class, 'get_imagesx'])->name('get_images');

Route::get('/UCC_UPDATE', [AdminPageController::class, 'ucc_update'])->name('ucc_update');

Route::resource('/customers', CustomerController::class, ['name' => 'customers']);

Route::resource('cash_request', CashRequestController::class, ['name' => 'cash_request']);

Route::get('/cash_request', [SuperAdminPageController::class, 'cash_request'])->name('cash_request');

Route::get('/cash_request_details/{id}', [SuperAdminPageController::class, 'cash_request_details'])->name('cash_request_details');

Route::get('/invoice/{invoice_id}', [InvoiceController::class, 'invoice'])->name('invoice.view');




Route::resource('/clientProjects', ClientProjectController::class, ['name' => 'clientProjects'])->middleware('auth');

Route::resource('/projectMilestones', ProjectMilestoneController::class, ['name' => 'projectMilestones'])->middleware('auth');

Route::resource('/milestoneReports', MilestoneReportController::class, ['name' => 'milestoneReports'])->middleware('auth');

Route::resource('/stockManagement', StockController::class, ['name' => 'stockManagement'])->middleware('auth');

Route::get('/projects-reports', [PageController::class, 'project_reports']);

Route::get('/projects', [PageController::class, 'projects']);

// emailing invoice to customer
Route::post('/mail-invoice', [InvoiceController::class, 'mail_invoice']);

Route::post('/mark-as-paid', [InvoiceLineController::class, 'mark_as_paid'])->middleware('auth');


Route::get('/export-excel', [ProjectController::class, 'export_excel']);

Route::get('/export-stock', [StockController::class, 'export_stock']);

Route::get('/export-sales', [InvoiceLineController::class, 'export_sales']);

















// Route::post('/create_requistion_request', [RequisitionController::class, 'create_requisition'])->name('create_requisition_request')->middleware('auth');
