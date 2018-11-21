<?php

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


//Client
Route::get('/', 'PagesController@home');

Route::get('/hello', function () {
    return "Hello World";
});


Route::get('/products-detail/{id}', 'PagesController@productsDetail');
Route::get('/shop/{show?}/{sortBy?}/{categoryId?}', 'PagesController@shop');
Route::get('/about', 'PagesController@about');
Route::get('/myaccount', 'PagesController@myaccount');
Route::get('/contact', 'PagesController@contact');
Route::get('/shopping-cart', 'PagesController@shoppingCart');
Route::get('/checkout', 'PagesController@checkout');
Route::get('/checkout-success', 'PagesController@checkoutSuccess');
Route::get('/logout', 'PagesController@logout');
Route::get('/confirm-payment', 'PagesController@confirmPayment');
Route::get('/confirm-payment-no-id', 'PagesController@confirmPaymentNoOrderId');
Route::get('/track-order', 'PagesController@trackOrder');


Route::post('/add-to-cart', 'PagesController@addToCart');
Route::post('/remove-item-cart', 'PagesController@removeItemCart');
Route::post('/fetch-item-cart', 'PagesController@fetchItemCart');
Route::post('/change-quantity-item-cart', 'PagesController@changeQuantityItemCart');
Route::post('/confirm-order', 'PagesController@confirmOrder');
Route::post('/confirm-payment', 'PagesController@confirmPaymentSubmit');
Route::post('/track-order', 'PagesController@trackOrderSubmit');


Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/test', function(){
    return "get method";

});

Route::post('/test',  function(){
    return "post method";

});
Auth::routes();
//


//Admin
Route::get('/admin', 'PagesController@adminLogin');
Route::get('/admin-logout', 'PagesController@adminLogout');
Route::post('/admin-login', 'PagesController@adminLoginPost');


Route::get('/admin/order', 'PagesController@adminOrder');
Route::get('/admin/order-details/{userOrderId}', 'PagesController@adminOrderDetails');
Route::get('/admin/order-proceed/{userOrderId}', 'PagesController@adminOrderProceed');
Route::get('/admin/order-complete/{userOrderId}', 'PagesController@adminOrderComplete');
Route::get('/admin/products', 'PagesController@adminProducts');
Route::get('/admin/product-create', 'PagesController@adminProductCreate');
Route::get('/admin/product-update/{productId}', 'PagesController@adminProductUpdate');
Route::get('/admin/product-details/{productId}/{tab}', 'PagesController@adminProductDetails');
Route::get('/admin/product-size-create/{productId}', 'PagesController@adminProductSizeCreate');
Route::get('/admin/product-image-create/{productId}', 'PagesController@adminProductImageCreate');


Route::post('/admin/order-proceed', 'PagesController@adminOrderProceedSubmit');
Route::post('/admin/order-complete', 'PagesController@adminOrderCompleteSubmit');
Route::post('/admin/product-create', 'PagesController@adminProductCreateSubmit');
Route::post('/admin/product-update', 'PagesController@adminProductUpdateSubmit');
Route::post('/admin/product-size-create', 'PagesController@adminProductSizeCreateSubmit');
Route::post('/admin/product-delete', 'PagesController@adminProductDelete');
Route::post('/admin/product-setnewold', 'PagesController@adminProductSetNewOld');
Route::post('/admin/product-activate', 'PagesController@adminProductActivate');
Route::post('/admin/product-deactivate', 'PagesController@adminProductDeactivate');
Route::post('/admin/product-size-delete', 'PagesController@adminProductSizeDelete');
Route::post('/admin/product-image-delete', 'PagesController@adminProductImageDelete');
Route::post('/admin/product-image-create', 'PagesController@adminProductImageCreateSubmit');



//
