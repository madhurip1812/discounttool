<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::any('/admin/{username?}/{password?}/{date?}/{countrycode?}/{langauge?}','UserLoginController@index')->name('userlogin');
Route::get('/logout','UserLoginController@logout')->name('logout');
<<<<<<< HEAD
Route::any('/addcashback/{id?}','CashbackController@addcashback')->name('addcashback');
Route::any('/listcashback','CashbackController@listcashback')->name('listcashback');
=======

Route::any('/addcashback','CashbackController@addcashback')->name('addcashback');
>>>>>>> 24f42e4533875f369a7b4c48cb28cce16ca90833
Route::any('/admin/{id?}','CashbackController@main')->name('main');
Route::any('/excludeitems','CouponController@excludeitems')->name('excludeitems');
Route::get('/CouponExcludeIds', 'CouponController@CouponExcludeIds')->name('CouponExcludeIds');

