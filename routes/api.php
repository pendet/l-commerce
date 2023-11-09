<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Route::prefix('v1')->group(function() {
    Route::middleware(['auth:api', 'admin'])->group( function () {
        Route::get('/user', [AuthController::class, 'getUser']);
        Route::post('logout', [AuthController::class, 'logout']);

        Route::apiResource('products', ProductController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('categories', CategoryController::class)->except('show');
        Route::get('/categories/tree', [CategoryController::class, 'getAsTree']);
        Route::get('/countries', [CustomerController::class, 'countries']);
        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/statuses', [OrderController::class, 'getStatuses']);
        Route::post('orders/change-status/{order}/{status}', [OrderController::class, 'changeStatus']);
        Route::get('orders/{order}', [OrderController::class, 'view']);

        // Dashboard Routes
        Route::get('/dashboard/customers-count', [DashboardController::class, 'activeCustomers']);
        Route::get('/dashboard/products-count', [DashboardController::class, 'activeProducts']);
        Route::get('/dashboard/orders-count', [DashboardController::class, 'paidOrders']);
        Route::get('/dashboard/income-amount', [DashboardController::class, 'totalIncome']);
        Route::get('/dashboard/orders-by-country', [DashboardController::class, 'ordersByCountry']);
        Route::get('/dashboard/latest-customers', [DashboardController::class, 'latestCustomers']);
        Route::get('/dashboard/latest-orders', [DashboardController::class, 'latestOrders']);

        // Report routes
        Route::get('/report/orders', [ReportController::class, 'orders']);
        Route::get('/report/customers', [ReportController::class, 'customers']);
    });
// });
   
