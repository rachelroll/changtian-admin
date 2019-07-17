<?php

use Illuminate\Routing\Router;


Admin::registerAuthRoutes();
Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('auth/users', 'AdminUserController')->names('admin.auth.users');
    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('goods', GoodsController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('orders', OrderController::class);
    $router->get('order/print', 'OrderController@print')->name('admin.order.print');
    $router->resource('order-items', OrderItemController::class);
    $router->resource('banners', BannerController::class);
    $router->get('order/update-status/{id}', 'OrderController@updateStatus')->name('admin.order.update-status');

});


