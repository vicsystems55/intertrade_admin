<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\RequisitionController;


use App\Http\Controllers\TpsaNotificationController;

use App\Http\Controllers\InvoiceController;






use Illuminate\Support\Facades\Auth;

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

Route::resource('invoices', InvoiceController::class, ['name' => 'invoices']);

Route::post('/notify_email', [TpsaNotificationController::class, 'notify_email']);
