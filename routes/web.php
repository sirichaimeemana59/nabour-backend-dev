<?php

Auth::routes();
Route::get('/','HomeController@login');

Route::get('/auth/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//User settings
Route::any('settings', 'SettingsController@index');
Route::any('settings/password', 'SettingsController@password');
Route::any('settings/language', 'SettingsController@language');

//File route...
Route::any('upload-file', 'FileController@upload');
Route::any('upload-profile-pic', 'FileController@uploadProfileImg');

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
Route::get('customer/service/quotation/add/{id}/{ip?}', 'RootAdmin\QuotationController@index');
Route::post('service/quotation/add/insert', 'RootAdmin\QuotationController@create');
Route::get('service/quotation_list', 'RootAdmin\QuotationController@index');
Route::post('service/quotation/detail', 'RootAdmin\QuotationController@detail');
Route::get('customer/service/quotation/update/form/{id?}', 'RootAdmin\QuotationController@edit');
Route::post('service/quotation/update/file', 'RootAdmin\QuotationController@update');
Route::get('service/quotation/check/quotation/{id?}/{lead_id?}', 'RootAdmin\QuotationController@check');
Route::get('service/quotation/check_out/quotation/{id?}/{lead_id?}', 'RootAdmin\QuotationController@check_out');
Route::get('service/quotation/print_quotation/{id?}', 'RootAdmin\QuotationController@print');
Route::get('service/quotation/success/{id?}', 'RootAdmin\QuotationController@success');
Route::get('service/quotation/cancel/{id?}', 'RootAdmin\QuotationController@cancel');
Route::post('service/quotation/delete', 'RootAdmin\QuotationController@destroy');
Route::post('service/quotation/check', 'RootAdmin\QuotationController@restore');

Route::any('quotation/list', 'RootAdmin\QuotationController@quotationList');
Route::any('contract/list', 'RootAdmin\ContractsignController@contractList');
//End Quotation

//Quotation Sales
Route::get('customer/service/sales/quotation/add/{id}/{ip?}', 'Sales\QuotationController@index');
Route::post('service/sales/quotation/add/insert', 'Sales\QuotationController@create');
Route::get('service/sales/quotation_list', 'Sales\QuotationController@index');
Route::post('service/sales/quotation/detail', 'Sales\QuotationController@detail');
Route::get('customer/service/sales/quotation/update/form/{id?}', 'Sales\QuotationController@edit');
Route::post('service/sales/quotation/update/file', 'Sales\QuotationController@update');
Route::get('service/sales/quotation/check/quotation/{id?}/{lead_id?}', 'Sales\QuotationController@check');
Route::get('service/sales/quotation/check_out/quotation/{id?}/{lead_id?}', 'Sales\QuotationController@check_out');
Route::get('service/sales/quotation/print_quotation/{id?}', 'Sales\QuotationController@print');
Route::get('service/sales/quotation/success/{id?}', 'Sales\QuotationController@success');
Route::get('service/sales/quotation/cancel/{id?}', 'Sales\QuotationController@cancel');
Route::post('service/sales/quotation/delete', 'Sales\QuotationController@destroy');
Route::post('service/sales/quotation/check', 'Sales\QuotationController@restore');

Route::any('quotation/sales/list', 'Sales\QuotationController@quotationList');
Route::any('contract/sales/list', 'Sales\ContractsignController@contractList');
//End Quotation Sales

//Customerservice/package/add
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
Route::get('service/contract/sign/quotation/{quotation_code?}/{code?}', 'RootAdmin\ContractsignController@index');
Route::get('customer/service/contract/sign/form/{id?}/{customer_id?}', 'RootAdmin\ContractsignController@create');
Route::post('service/contract/sign/add', 'RootAdmin\ContractsignController@save');
Route::post('service/contract/sign/update', 'RootAdmin\ContractsignController@update');
Route::post('customer/contract/approved', 'RootAdmin\ContractsignController@approved');
//End Contract

//Contract sign no Sales
Route::get('service/sales/contract/sign/quotation/{quotation_code?}/{code?}', 'Sales\ContractsignController@index');
Route::get('customer/service/sales/contract/sign/form/{id?}/{customer_id?}', 'Sales\ContractsignController@create');
Route::post('service/sales/contract/sign/add', 'Sales\ContractsignController@save');
Route::post('service/sales/contract/sign/update', 'Sales\ContractsignController@update');
Route::post('customer/sales/contract/approved', 'Sales\ContractsignController@approved');
//End Contract Sales

//Report Quotation
Route::any('report_quotation', 'RootAdmin\QuotationreportController@index');
Route::get('report_quotation/view/{id?}', 'RootAdmin\QuotationreportController@view');
Route::post('report_quotation/detail', 'RootAdmin\QuotationreportController@detail');


Route::any('report_quotation/report_count', 'RootAdmin\QuotationreportController@report');
Route::get('report_quotation_excel', 'RootAdmin\QuotationreportController@excel');
//Route::get('report_quotation/ratio', 'RootAdmin\QuotationreportController@ratio');
Route::any('report_quotation/ratio/report', 'RootAdmin\QuotationreportController@ratio');
Route::post('report_quotation/ratio/report/date', 'RootAdmin\QuotationreportController@date');
Route::post('report_quotation/ratio/report/quotation', 'RootAdmin\QuotationreportController@quotation');
Route::post('report_quotation/ratio/report/quotation/sum', 'RootAdmin\QuotationreportController@sum');
Route::post('report_quotation/ratio/report/quotation/budget', 'RootAdmin\QuotationreportController@budget');
Route::post('report_quotation_ratio_excel', 'RootAdmin\QuotationreportController@excel_ratio');
Route::any('report_quotation/report/chart', 'RootAdmin\QuotationreportController@chart_form');

//Ratio
Route::any('report_quotation/report/chart/ratio', 'RootAdmin\QuotationreportController@ratio_report');
Route::post('report_quotation/report/chart/ratio_lead', 'RootAdmin\QuotationreportController@ratio_lead');
//End Report Quotation


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
Route::any('root/admin/edit/receipt', 'RootAdmin\EditreceiptController@getReceiptForAdjust');
Route::any('root/admin/edit/receipt/save', 'RootAdmin\EditreceiptController@adjustReceipt');

// Property
Route::any('customer/property/list', 'RootAdmin\PropertyController@index');
Route::any('customer/property/demo/list', 'RootAdmin\PropertyController@demoList');
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

//Demo Property sales
Route::any('sales/demo-property/list-property', 'Sales\PropertyFormController@index');
Route::post('sales/demo-property/add','Sales\PropertyFormController@create');
Route::any('home/code', 'PropertyFormController@code');
Route::any('home/form', 'PropertyFormController@form');
Route::post('sales/property-form/delete','Sales\PropertyFormController@delete_form');
Route::get('sales/property-form/view/{id}', 'Sales\PropertyFormController@view_form');

//Demo Property admint
Route::any('admin/demo-property/list-property', 'RootAdmin\PropertyFormController@index');
Route::post('admin/demo-property/add','RootAdmin\PropertyController@create_demo');
//Route::any('admin/home/code', 'RootAdmin\PropertyFormController@code');
//Route::any('admin/home/form', 'RootAdmin\PropertyFormController@form');
//Route::post('admin/property-form/delete','RootAdmin\PropertyFormController@delete_form');
//Route::get('admin/property-form/view/{id}', 'RootAdmin\PropertyFormController@view_form');
Route::post('admin/property/reset', 'RootAdmin\PropertyController@reset');
Route::post('admin/property/assign', 'RootAdmin\PropertyController@assignDemoProperty');

//Edit receipt
Route::get('root/admin/upload_file/receipt', 'RootAdmin\EditreceiptController@index');
Route::resource('root/admin/upload_file/receipt/file', 'RootAdmin\EditreceiptController@upload');
Route::post('root/admin/search/receipt', 'RootAdmin\EditreceiptController@searchreceipt');
Route::post('root/admin/upload_file/receipt/file/submit', 'RootAdmin\EditreceiptController@create');
//End Edit receipt