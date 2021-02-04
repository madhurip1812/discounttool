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

Route::any('/admin/{username?}/{password?}/{date?}/{countrycode?}/{langauge?}','UserLoginController@index')->name('userlogin');
Route::get('/logout','UserLoginController@logout')->name('logout');
Route::any('/addcashback','CashbackController@addcashback')->name('addcashback');
Route::any('/admin/{id?}','CashbackController@main')->name('main');
