<?php

use Encore\Admin\Facades\Admin;
// use Illuminate\Routing\Route;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.as'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', CategoriesController::class);
    $router->resource('colors', ColorsController::class);
    $router->resource('sizes', SizesController::class);
    $router->resource('products', ProductssController::class);
    $router->resource('customers', CustomersController::class);
    $router->resource('orders', OrdersController::class);

});

