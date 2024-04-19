<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Item\ItemController;
use App\Http\Controllers\Api\V1\User\AuthController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Controllers\Api\V1\table\tablController;
use App\Http\Controllers\Api\V1\General\PosController;
use App\Http\Controllers\Api\V1\Item\OptionController;
use App\Http\Controllers\Api\V1\Payment\TaxController;
use App\Http\Controllers\Api\V1\Item\PackageController;
use App\Http\Controllers\Api\V1\waiter\WaiterController;
use App\Http\Controllers\Api\V1\General\ServiceController;
use App\Http\Controllers\Api\V1\Item\ItemCategoryController;
use App\Http\Controllers\Api\V1\Order\OrderPaymentController;
use App\Http\Controllers\Api\V1\Payment\PaymentTypeController;
use App\Http\Controllers\Api\V1\Item\ItemSubCategoryController;

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


Route::apiResource('users', UserController::class);
Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, 'Login']);
Route::post('logout', [AuthController::class, 'Logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('switchPos', [PosController::class, 'sowitchPos']);
});


Route::prefix('general')->group(function () {
    Route::apiResource('pos', PosController::class);
    Route::apiResource('services', ServiceController::class);
});


Route::prefix('item')->group(function () {
    Route::apiResource('itemcategory', ItemCategoryController::class);
    Route::apiResource('itemsubcategory', ItemSubCategoryController::class);
    Route::apiResource('item', ItemController::class);

    Route::apiResource('option', OptionController::class);
    Route::apiResource('package', PackageController::class);
});



Route::prefix('payment')->group(function () {
    Route::apiResource('payment-type', PaymentTypeController::class);
    Route::apiResource('tax', TaxController::class);
});

Route::prefix('table')->group(function () {
    Route::apiResource('table', tablController::class);
});
Route::prefix('waiter')->group(function () {
    Route::apiResource('waiter', WaiterController::class);
});
Route::prefix('order')->group(function () {
    Route::apiResource('order-payment', OrderPaymentController::class);
});
