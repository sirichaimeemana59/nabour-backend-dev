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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('auth/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/root/admin/property/list', 'RootAdmin\PropertyController@index');

Route::get('/customer/customer/list', 'HomeController@rootAdminHome');
Route::get('/projects', 'HomeController@nabourAdminHome');
Route::get('/home', 'HomeController@SalesHome');