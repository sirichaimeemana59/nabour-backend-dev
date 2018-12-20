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
Route::any('customer/leads/list', 'RootAdmin\LeadsController@index');
Route::post('customer/Lead_form/add', 'RootAdmin\LeadsController@create');
Route::get('customer/Lead_form/add/list', 'RootAdmin\LeadsController@index');
Route::post('customer/Lead_form/delete', 'RootAdmin\LeadsController@destroy');
Route::post('customer/list_update_lead', 'RootAdmin\LeadsController@edit');
Route::post('customer/Lead_form/update', 'RootAdmin\LeadsController@update');
//End Leads

//Leads Sales
Route::any('customer/sales/leads/list','Sales\LeadsController@index');
Route::post('customer/sales/Lead_form/add','Sales\LeadsController@create');
Route::get('customer/sales/Lead_form/add/list','Sales\LeadsController@index');
Route::post('customer/sales/Lead_form/delete','Sales\LeadsController@destroy');
Route::post('customer/sales/list_update_lead','Sales\LeadsController@edit');
Route::post('customer/sales/Lead_form/update','Sales\LeadsController@update');
//End Leads Sales

//Product
//Package
Route::get('service/package/add', 'RootAdmin\PackageController@index');
Route::get('service/package/service/add', 'RootAdmin\PackageController@index');
Route::post('service/package/add_package', 'RootAdmin\PackageController@add');
Route::post('service/list_update_package', 'RootAdmin\PackageController@package_detail');
Route::post('service/package/update_package', 'RootAdmin\PackageController@update');
Route::post('service/package/delete_open', 'RootAdmin\PackageController@delete_open');
Route::post('service/package/delete', 'RootAdmin\PackageController@delete');

//Service
Route::get('service/package/service/add', 'RootAdmin\PackageController@index_service');
Route::post('service/package/add_service', 'RootAdmin\PackageController@add_service');
Route::post('service/list_update_service', 'RootAdmin\PackageController@service_detail');
Route::post('service/package/update_service', 'RootAdmin\PackageController@update_service');
Route::post('service/package/delete_service', 'RootAdmin\PackageController@delete_service');
Route::post('service/package/delete_service_open', 'RootAdmin\PackageController@delete_service_open');
//End Product

//Quotation
Route::get('service/quotation/add/{id}/{ip?}', 'RootAdmin\QuotationController@index');
Route::post('service/quotation/add/insert', 'RootAdmin\QuotationController@create');
Route::get('service/quotation_list', 'RootAdmin\QuotationController@index');
Route::post('service/quotation/detail', 'RootAdmin\QuotationController@detail');
Route::get('service/quotation/update/form/{id?}', 'RootAdmin\QuotationController@edit');
Route::post('service/quotation/update/file', 'RootAdmin\QuotationController@update');
Route::get('service/quotation/check/quotation/{id?}/{lead_id?}', 'RootAdmin\QuotationController@check');
Route::get('service/quotation/check_out/quotation/{id?}/{lead_id?}', 'RootAdmin\QuotationController@check_out');
Route::get('service/quotation/print_quotation/{id?}', 'RootAdmin\QuotationController@print');
Route::get('service/quotation/success/{id?}', 'RootAdmin\QuotationController@success');
Route::get('service/quotation/cancel/{id?}', 'RootAdmin\QuotationController@cancel');

Route::any('quotation/list', 'RootAdmin\QuotationController@quotationList');
Route::any('contract/list', 'RootAdmin\ContractsignController@contractList');
//End Quotation

//Customer
Route::any('customer/customer/list', 'RootAdmin\CustomerController@index');
Route::post('customer/Customer_form/add', 'RootAdmin\CustomerController@create');
Route::post('customer/list_update_customer', 'RootAdmin\CustomerController@edit');
Route::post('customer/Customer_form/update', 'RootAdmin\CustomerController@update');
Route::post('customer/Customer_form/delete', 'RootAdmin\CustomerController@destroy');
Route::post('customer/Customer_form/check', 'RootAdmin\CustomerController@check');
//End Customer

//Customer Sales
Route::any('customer/sales/customer/list', 'Sales\CustomerController@index');
Route::post('customer/sales/Customer_form/add', 'Sales\CustomerController@create');
Route::post('customer/sales/list_update_customer', 'Sales\CustomerController@edit');
Route::post('customer/sales/Customer_form/update', 'Sales\CustomerController@update');
Route::post('customer/sales/Customer_form/delete', 'Sales\CustomerController@destroy');
Route::post('customer/sales/Customer_form/check', 'Sales\CustomerController@check');
//End Customer Sales

//Contract sign no
Route::get('service/contract/sign/quotation/{quotation_code?}/{lead_id?}', 'RootAdmin\ContractsignController@index');
Route::get('service/contract/sign/form/{id?}/{quo_id?}', 'RootAdmin\ContractsignController@create');
Route::post('service/contract/sign/add', 'RootAdmin\ContractsignController@save');
Route::post('service/contract/sign/update', 'RootAdmin\ContractsignController@update');
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

//-------------------------------- Sales Route --------------------------------------//
Route::any('sales/quotation/list', 'Sales\QuotationController@quotationList');
Route::any('sales/contract/list', 'Sales\ContractsignController@contractList');
// Demo Site
Route::any('sales/property/list', 'Sales\PropertyController@index');
Route::get('sales/property/view/{id}', 'Sales\PropertyController@view');
Route::post('sales/property/reset', 'Sales\PropertyController@reset');
Route::post('sales/property/assign', 'Sales\PropertyController@assignDemoProperty');
Route::post('sales/property/disable', 'Sales\PropertyController@disablePropertyDemo');
Route::post('sales/property/enable', 'Sales\PropertyController@enablePropertyDemo');
