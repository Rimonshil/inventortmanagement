<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(
    [
        'middleware' => 'api',
        'namespace'  => 'App\Http\Controllers',
        'prefix'     => 'auth',
    ],
    function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');
        Route::post('logout', 'AuthController@logout');
        Route::post('me', 'AuthController@me');
        Route::post('refresh', 'AuthController@refresh');
    }
);

Route::apiResource('/employee',EmployeeController::class);
Route::apiResource('/supplier',SupplierController::class);
Route::apiResource('/category',CategoryController::class);
Route::apiResource('/product',ProductController::class);
Route::apiResource('/expense',ExpenseController::class);
Route::apiResource('/customer',CustomersController::class);

// Route::get('/delete-alumni-members/{id}', [AlumniController::class, 'destroy']);

Route::get('/salary/paid/{id}',[SalaryController::class, 'paid']);
// Route::apiResource('/employee','Api\EmployeeController');

Route::get('/getting/product/{id}',[PosController::class,'subproduct']);
Route::get('/addToCart/{id}',[CartController::class,'addToCart']);
Route::get('/cart/product',[CartController::class,'cartProduct']);
Route::get('/remove/cart/{id}',[CartController::class,'removeCart']);
Route::get('/increment/{id}',[CartController::class,'increment']);
Route::get('/decrement/{id}',[CartController::class,'decrement']);
Route::get('/vats',[CartController::class,'vat']);
Route::post('/orderdone',[CartController::class,'orderdone']);

Route::get('/orders',[OrderController::class,'TodayOrder']);
Route::get('/order/details/{id}',[OrderController::class,'orderDetails']);
Route::get('/order/orderdetails/{id}',[OrderController::class,'orderdetailsAll']);

