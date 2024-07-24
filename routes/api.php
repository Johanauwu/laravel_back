<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;

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

// Route::post('login', [authController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([ 'middleware' => 'api', 'prefix' => 'auth' ], function ($router) {
    Route::post('login', [authController::class, 'login']);
    Route::post('logout', [authController::class, 'logout']);
    Route::post('refresh',[authController::class, 'refresh']);
    Route::post('me', [authController::class, 'me']);
    Route::post('register', [authController::class, 'register']);
});



Route::namespace('Clientes')->prefix('clientes')->group(function(){
    Route::get('show/{dni}', [ClientsController::class, 'getClients']);
    Route::post('add', [ClientsController::class, 'addClients']);
    Route::post('edit', [ClientsController::class, 'editClientes']);
    Route::post('delete/{id}', [ClientsController::class, 'deleteClientes']); 
});

Route::namespace('Orders')->prefix('orders')->group(function(){ 
    Route::post('add', [OrdersController::class, 'addOrders']);
    Route::put('edit/{id}', [OrdersController::class, 'editOrders']);
    Route::post('delete/{id}', [OrdersController::class, 'deleteOrders']); 
});
Route::namespace('Products')->prefix('products')->group(function(){ 
    Route::post('add', [ProductsController::class, 'addProducts']);
    Route::put('edit/{book_id}', [ProductsController::class, 'editProducts']);
    Route::post('delete/{id}', [ProductsController::class, 'deleteProducts']); 
    Route::post('show', [ProductsController::class, 'getProducts']);
});