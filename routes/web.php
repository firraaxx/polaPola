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

// use Illuminate\Routing\Route;

use App\Banner;
use App\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = \App\Product::paginate(10);
    $banners = \App\Banner::all();
    return view('home', ['products' => $products, 'banners' => $banners]);
});

Auth::routes();
Route::resource('users', 'UserController');

Route::group(['middleware' => ['auth', 'auth.admin']], function () {
    Route::resource('users', 'UserController');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('orders', 'OrderController');
    Route::resource('banners', 'BannerController');
    Route::resource('dashboard', 'DashboardController');
    Route::get('/detail/{id}', 'OrderController@detail');
    Route::get('/peramalan', 'OrderController@peramalan');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', 'HomeController@cart');
    Route::post('/shop/{id}', 'OrderController@simpan');
    Route::post('/hapuscart/{id}', 'HomeController@hapuscart');
});
// Route::resource('belanja', 'BelanjaController');

Route::resource('users', 'UserController');

// Route::get('/detail', 'HomeController@detail');

Route::get('/show/{id}', 'HomeController@show');
Route::get('/belanja/{id}', 'HomeController@kategori');
Route::get('/belanja', 'HomeController@shop');

Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/belanja', function(){
//     $products = \App\Product::all();
//     return view('shop', compact('products'))->with(['banners' => Banner::all(), 'categories' => Category::all()]);
// });

//dashboard
