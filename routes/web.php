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

//Leads
Route::get('customer/leads/list', 'leads\LeadsController@index');
Route::post('customer/Lead_form/add', 'leads\LeadsController@create');
Route::get('customer/Lead_form/add/list', 'leads\LeadsController@index');
Route::post('customer/Lead_form/delete', 'leads\LeadsController@destroy');
Route::post('customer/list_update_lead', 'leads\LeadsController@edit');
Route::post('customer/Lead_form/update', 'leads\LeadsController@update');
//End Leads

//Product
//Package
Route::get('service/package/add', 'product\PackageController@index');
Route::get('service/package/service/add', 'product\PackageController@index');
Route::post('service/package/add_package', 'product\PackageController@add');
Route::post('service/list_update_package', 'product\PackageController@package_detail');
Route::post('service/package/update_package', 'product\PackageController@update');
Route::post('service/package/delete_open', 'product\PackageController@delete_open');
Route::post('service/package/delete', 'product\PackageController@delete');

//Service
Route::get('service/package/service/add', 'product\PackageController@index_service');
Route::post('service/package/add_service', 'product\PackageController@add_service');
Route::post('service/list_update_service', 'product\PackageController@service_detail');
Route::post('service/package/update_service', 'product\PackageController@update_service');
Route::post('service/package/delete_service', 'product\PackageController@delete_service');
Route::post('service/package/delete_service_open', 'product\PackageController@delete_service_open');
//End Product

//Product

//End Product