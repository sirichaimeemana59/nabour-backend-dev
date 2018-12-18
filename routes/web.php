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

Route::get('/auth/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/root/admin/property/list', 'RootAdmin\PropertyController@index');

Route::get('/customer/customer/list', 'HomeController@rootAdminHome');
Route::get('/projects', 'HomeController@nabourAdminHome');
Route::get('/home', 'HomeController@SalesHome');

//Leads
Route::any('customer/leads/list', 'leads\LeadsController@index');
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

//Quotation
Route::get('service/quotation/add/{id}/{ip?}', 'Quotation\QuotationController@index');
Route::post('service/quotation/add/insert', 'Quotation\QuotationController@create');
Route::get('service/quotation_list', 'Quotation\QuotationController@index');
Route::post('service/quotation/detail', 'Quotation\QuotationController@detail');
Route::get('service/quotation/update/form/{id?}', 'Quotation\QuotationController@edit');
Route::post('service/quotation/update/file', 'Quotation\QuotationController@update');
Route::get('service/quotation/check/quotation/{id?}/{lead_id?}', 'Quotation\QuotationController@check');
Route::get('service/quotation/check_out/quotation/{id?}/{lead_id?}', 'Quotation\QuotationController@check_out');
Route::get('service/quotation/print_quotation/{id?}', 'Quotation\QuotationController@print');
Route::get('service/quotation/success/{id?}', 'Quotation\QuotationController@success');
Route::get('service/quotation/cancel/{id?}', 'Quotation\QuotationController@cancel');

Route::any('quotation/list', 'Quotation\QuotationController@quotationList');
//End Quotation

//Customer
Route::any('customer/customer/list', 'Customer\CustomerController@index');
Route::post('customer/Customer_form/add', 'Customer\CustomerController@create');
Route::post('customer/list_update_customer', 'Customer\CustomerController@edit');
Route::post('customer/Customer_form/update', 'Customer\CustomerController@update');
Route::post('customer/Customer_form/delete', 'Customer\CustomerController@destroy');
Route::post('customer/Customer_form/check', 'Customer\CustomerController@check');
//End Customer

//Contract sign no
Route::get('service/contract/sign/quotation/{quotation_code?}/{lead_id?}', 'Contract\ContractsignController@index');
Route::get('service/contract/sign/form/{id?}/{quo_id?}', 'Contract\ContractsignController@create');
Route::post('service/contract/sign/add', 'Contract\ContractsignController@save');
Route::post('service/contract/sign/update', 'Contract\ContractsignController@update');
//End Contract

//---------------------------  Nabour officer Route --------------------------------------------//

// Admin
Route::get('root/admin/admin-system/list', 'RootAdmin\AdminSystemController@adminList');
Route::post('root/admin/admin-system/add', 'RootAdmin\AdminSystemController@addAdmin');
Route::post('root/admin/admin-system/view', 'RootAdmin\AdminSystemController@viewAdmin');
Route::post('root/admin/admin-system/edit/get', 'RootAdmin\AdminSystemController@getAdmin');
Route::post('root/admin/admin-system/edit', 'RootAdmin\AdminSystemController@editAdmin');
Route::any('root/admin/admin-system/active', 'RootAdmin\AdminSystemController@setActive');
Route::post('root/admin/admin-system/delete', 'RootAdmin\AdminSystemController@deleteAdmin');

// Sale
Route::get('admin/sales/list', 'RootAdmin\SalesOfficerController@salesList');
Route::post('admin/sales/add', 'RootAdmin\SalesOfficerController@addSales');
Route::post('admin/sales/view', 'RootAdmin\SalesOfficerController@viewSales');
Route::post('admin/sales/edit/get', 'RootAdmin\SalesOfficerController@getSales');
Route::post('admin/sales/edit', 'RootAdmin\SalesOfficerController@editSales');
Route::any('admin/sales/active', 'RootAdmin\SalesOfficerController@setActive');
Route::post('admin/sales/delete', 'RootAdmin\SalesOfficerController@deleteSales');


//Invoice Receipt
Route::get('root/admin/receipt', 'RootAdmin\feesBillsController@index');
Route::post('root/admin/receipt/show', 'RootAdmin\feesBillsController@show');
Route::post('root/admin/receipt/delete', 'RootAdmin\feesBillsController@destroy');
Route::get('root/admin/property/receipt/import/{id}','RootAdmin\feesBillsController@importReceipt');
Route::post('root/admin/property/receipt/import','RootAdmin\feesBillsController@startImportReceipt');
Route::get('root/admin/property/expense/import/{id}','RootAdmin\feesBillsController@importExpense');
Route::post('root/admin/property/expense/import','RootAdmin\feesBillsController@startImportExpense');

// Property
Route::any('customer/property/list', 'RootAdmin\PropertyController@index');
Route::get('customer/property/demo/list', 'RootAdmin\PropertyController@demoList');
Route::any('customer/property/edit/{id}', 'RootAdmin\PropertyController@edit');
Route::any('customer/property/view/{id}', 'RootAdmin\PropertyController@view');
Route::any('customer/property/add', 'RootAdmin\PropertyController@add');
Route::any('customer/property/status', 'RootAdmin\PropertyController@status');
Route::get('customer/property/directlogin/{id}', 'RootAdmin\PropertyController@directLogin');
Route::post('customer/property/addunit', 'RootAdmin\PropertyController@createUnitCsv');
Route::post('customer/property/update-unit', 'RootAdmin\PropertyController@addUnitCsvAfter');
Route::post('customer/property/edit-data', 'RootAdmin\PropertyController@updatePropertyUnitCsv');

// Initial Water&Electric Meters of Property
Route::any('root/admin/property/initial-meter/get', 'RootAdmin\PropertyController@getInitialUnit');
Route::post('root/admin/property/initial-meter/save', 'RootAdmin\PropertyController@importInitialUnit');

// Property Feature
Route::any('root/admin/property-feature/edit/get', 'RootAdmin\PropertyController@getPropertyFeature');
Route::post('root/admin/property-feature/edit/save', 'RootAdmin\PropertyController@editPropertyFeature');

