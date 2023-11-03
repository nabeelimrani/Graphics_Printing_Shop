<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/checkqty', [ProductController::class, 'checkqty']);
Route::get('/checksqrft', [ProductController::class, 'checksqrft']);
Route::get('/order/delorder', [OrderController::class, 'delorder']);
Route::get('/order/delproduct', [OrderController::class, 'delproduct']);
Route::get('/order/view', [OrderController::class, 'orderView'])->name("orderView");
Route::get('/order/getDeails/{id}', [OrderController::class, 'getDetails']);
Route::get('/invoice',[HomeController::class, 'invoice']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

Route::post('/sumbit', [UserController::class, 'submit'])->name('submit');

Route::get('/area', [AreaController::class, 'area'])->name('area');
Route::post('/area/submit', [AreaController::class, 'areasubmit'])->name('areasubmit');
Route::get('/area/view', [AreaController::class, 'areaview'])->name('areaview');
Route::post('/area/del/{id}', [AreaController::class, 'areadel'])->name('areadel');
Route::post('/area/edit/{id}', [AreaController::class, 'areaedit'])->name('areaedit');

Route::get('/customer', [CustomerController::class, 'customer'])->name('customer');
Route::post('/customer/store', [CustomerController::class, 'customerstore'])->name('customerstore');
Route::get('/customer/view', [CustomerController::class, 'customerview'])->name('customerview');
Route::post('/customer/del/{id}', [CustomerController::class, 'customerdel'])->name('customerdel');
Route::post('/customer/edit/{id}', [CustomerController::class, 'customeredit'])->name('customeredit');
Route::get('/storeorder', [OrderController::class, 'store']);

Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::post('/product/store', [ProductController::class, 'productstore'])->name('productstore');
Route::get('/product/view', [ProductController::class, 'productview'])->name('productview');
Route::post('/product/del/{id}', [ProductController::class, 'productdel'])->name('productdel');
Route::post('/product/edit/{id}', [ProductController::class, 'productedit'])->name('productedit');

Route::get('/order', [OrderController::class, 'order'])->name('order');
Route::get('/get-products/{category}', [ProductController::class, 'getProducts'])->name('getproductbycategory');
Route::get('/get-itemname/{product}', [ProductController::class, 'getItemName']);
Route::post('/save-data-endpoint', [ProductController::class, 'saveorder']);
Route::get('/get-disc/{customerId}',[CustomerController::class, 'getDiscount']);


Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::get('/category/view', [CategoryController::class, 'categoryview'])->name('categoryview');
Route::post('/category/submit', [CategoryController::class, 'categorysubmit'])->name('categorysubmit');
Route::post('/category/del/{id}', [CategoryController::class, 'categorydel'])->name('categorydel');
Route::post('/category/edit/{id}', [CategoryController::class, 'categoryedit'])->name('categoryedit');
