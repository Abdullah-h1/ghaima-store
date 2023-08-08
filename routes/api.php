<?php

use App\Admin\Actions\CustomActions;
use App\Http\Controllers\Api\UserController;
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);
Route::post('/auth/upload', [UserController::class, 'upload']);
Route::post('/forget-password', [UserController::class, 'forgetPassword']);

Route::get('/getProd', 'App\Http\Controllers\ProductsController@index');
Route::get('/getProd/{id}', 'App\Http\Controllers\ProductsController@show');
Route::get('/productsCate', 'App\Http\Controllers\ProductsController@productsCate');
Route::get('/categoryFilter/{id}', 'App\Http\Controllers\ProductsController@categoryFilter');

Route::get('/favorite/{id}', 'App\Http\Controllers\FavoriteController@index');
Route::get('/deleteRow/{id}', 'App\Http\Controllers\FavoriteController@deleteRow');
Route::post('/addFavorite', 'App\Http\Controllers\FavoriteController@addFavorite');


Route::post('/submitRating', 'App\Http\Controllers\RatingController@submitRating');


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [UserController::class, 'logout']);

    Route::post('/submitAddr', 'App\Http\Controllers\AddressController@submitAddr');
    Route::get('/getAddr', 'App\Http\Controllers\AddressController@getAddr');
    Route::post('/defaultAddress', 'App\Http\Controllers\AddressController@defaultAddress');
    Route::delete('/deleteAddress/{id}', 'App\Http\Controllers\AddressController@deleteAddress');
    
    Route::post('/addToCart', 'App\Http\Controllers\CartsController@addToCart');
    Route::get('/getCarts', 'App\Http\Controllers\CartsController@index');
    Route::put('/setQuantity/{id}', 'App\Http\Controllers\CartsController@setQuantity');
    Route::put('/reduceQuantity/{id}', 'App\Http\Controllers\CartsController@reduceQuantity');
    Route::delete('/deleteCart/{id}', 'App\Http\Controllers\CartsController@deleteCart');
    
    Route::post('/setOrders', 'App\Http\Controllers\OrdersController@store');
    Route::post('/receiveOrder', 'App\Http\Controllers\OrdersController@receiveOrder');
    Route::get('/getOrders', 'App\Http\Controllers\OrdersController@show');
    Route::post('/setPayments', 'App\Http\Controllers\OrdersController@setPayments');

});
Route::post('/deleteTableRows', [CustomActions::class, 'deleteTableRows']);