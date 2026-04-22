<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\Api\InstallationQuoteController;
use App\Http\Controllers\Api\InstallationLocationController;

use App\Http\Controllers\InvoiceController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProjectController;

use App\Http\Controllers\CustomerController;

use App\Http\Controllers\CashRequestController;


use App\Http\Controllers\FilemanagerController;
use App\Http\Controllers\InvoiceLineController;
use App\Http\Controllers\LoadAuditGenerationController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\TpsaNotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/create_requistion_request', [RequisitionController::class, 'create_requisition']);

Route::resource('products', ProductController::class, ['name' => 'products']);

Route::post('update-product-image', [ProductController::class, 'updateProductImage']);




Route::resource('product-category', ProductCategoryController::class, ['name' => 'products.categories']);

Route::get('products-search', [ProductController::class,'search']);

Route::get('products-search-keyword', [ProductController::class,'searchKeyword']);



Route::resource('customers', CustomerController::class, ['name' => 'cus']);

Route::resource('invoices', InvoiceController::class, ['name' => 'invoices']);

Route::resource('invoice_lines', InvoiceLineController::class, ['name' => 'invoice_line']);

Route::post('/notify_email', [TpsaNotificationController::class, 'notify_email']);

Route::get('/update_project_admin', [ProjectController::class, 'update_project_admin']);

Route::get('/project-reports', [ProjectController::class, 'project_reports']);

Route::post('/update-report-line', [ProjectController::class, 'update_report_line']);

Route::post('/save-folder-name', [FilemanagerController::class, 'renameFolder']);




// fetch sales records
Route::get('/sales-records', [InvoiceController::class, 'salesRecords']);


// mobile app functions
Route::post('/registerp', [ApiAuthController::class, 'register']);

Route::post('/loginp', [ApiAuthController::class, 'login']);

Route::post('/verify-otp', [ApiAuthController::class, 'verify_otp']);

Route::post('/resend-otp', [ApiAuthController::class, 'resend_otp']);

Route::post('/update-password', [ApiAuthController::class, 'updatePassword'])->middleware('auth:sanctum');


// generate audit

Route::post('/generate-audit', [LoadAuditGenerationController::class, 'generateAudit'])->middleware('auth:sanctum');

Route::get('/load-audits', [LoadAuditGenerationController::class, 'loadAudits'])->middleware('auth:sanctum');


// Installation Quotes
Route::post('/import-template', [InstallationQuoteController::class, 'import_template'])->middleware('auth:sanctum');
Route::get('/import-template', [InstallationQuoteController::class, 'index'])->middleware('auth:sanctum');

// New API endpoint for generating installation quotation data
Route::get('/generate-installation-quotation', [InstallationQuoteController::class, 'generate']);
// POST endpoint to store generated quotations (creates/updates customer and generated items)
Route::post('/generate-installation-quotation', [InstallationQuoteController::class, 'update_generate_quote'])->middleware('auth:sanctum');
// GET endpoint to fetch generated quotations list
Route::get('/installation-quotations', [InstallationQuoteController::class, 'quotations']);
// View specific quotation details
Route::get('/view-installation-quotation', [InstallationQuoteController::class, 'view_quotation']);

// Installation Locations (No SANCTUM middleware required)
Route::get('/installation-locations', [InstallationLocationController::class, 'index'])->name('installation-locations.index');
Route::post('/installation-locations', [InstallationLocationController::class, 'store'])->name('installation-locations.store');
Route::get('/installation-locations/{installation_location}', [InstallationLocationController::class, 'show'])->name('installation-locations.show');
Route::patch('/installation-locations/{installation_location}', [InstallationLocationController::class, 'update'])->name('installation-locations.update');
Route::delete('/installation-locations/{installation_location}', [InstallationLocationController::class, 'destroy'])->name('installation-locations.destroy');
Route::get('/installation-locations-statistics', [InstallationLocationController::class, 'statistics'])->name('installation-locations.statistics');
Route::post('/installation-locations-upload-excel', [InstallationLocationController::class, 'uploadExcel'])->name('installation-locations.uploadExcel');
Route::get('/installation-locations-export-excel', [InstallationLocationController::class, 'exportExcel'])->name('installation-locations.exportExcel');


