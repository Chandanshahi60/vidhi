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
//     return view('admin.welcome');
// });


// Front
Route::get('/about', 'Frontend\HomeController@about')->name('front.about');
Route::get('/contact', 'Frontend\HomeController@contact')->name('front.contact');
Route::get('/index', 'Frontend\HomeController@index')->name('front.index');
Route::get('/media', 'Frontend\HomeController@media')->name('front.media');
Route::get('/blog', 'Frontend\HomeController@blog')->name('front.blog');




//Auth::Routes();


// Login
Route::get('/', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\LoginController@login')->name('admin.post.login');

Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');

// Register
Route::get('/admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/admin/register', 'Auth\RegisterController@register')->name('register.store');

// Reset Password
Route::get('password/reset', 'Auth\Frontend\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\Frontend\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\Frontend\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\Frontend\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\Frontend\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\Frontend\ConfirmPasswordController@confirm');



Route::group(['middleware' => ['admin'],'namespace' => 'Backend'], function() {

    Route::get('/admin/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/admin/cities', 'DashboardController@cities')->name('get.cities');

    //User Master
    Route::group(['middleware' => ['permission:User Master'] ],function() {

        Route::get('/admin/users/create', 'UserController@create')->name('user-create')->middleware(['permission:User Create']);
        Route::get('/admin/users', 'UserController@index')->name('user-list')->middleware(['permission:User List']);
        Route::post('/admin/users/store', 'UserController@store')->name('user-save')->middleware(['permission:User Create']);
        Route::get('/admin/users/edit/{id}', 'UserController@edit')->name('user-edit')->middleware(['permission:User Edit']);
        Route::get('/admin/users/view/{id}', 'UserController@show')->name('user-view')->middleware(['permission:User View']);
        Route::post('/admin/users/update/{id}', 'UserController@update')->name('user-update')->middleware(['permission:User Update']);
        Route::get('/admin/users/destroy/{id}', 'UserController@destroy')->name('user-delete')->middleware(['permission:User Delete']);

    });


    Route::group(['middleware' => ['permission:Social Master'] ],function() {

        Route::get('/admin/Social/create', 'SocialController@create')->name('social-create')->middleware(['permission:Social Create']);
        Route::get('/admin/Social', 'SocialController@index')->name('social-list')->middleware(['permission:Social List']);
        Route::post('/admin/Social/store', 'SocialController@store')->name('social-save')->middleware(['permission:Social Create']);
        Route::get('/admin/Social/edit/{id}', 'SocialController@edit')->name('social-edit')->middleware(['permission:Social Edit']);
        Route::get('/admin/Social/view/{id}', 'SocialController@show')->name('social-view')->middleware(['permission:Social View']);
        Route::post('/admin/Social/update/{id}', 'SocialController@update')->name('social-update')->middleware(['permission:Social Update']);
        Route::get('/admin/Social/destroy/{id}', 'SocialController@destroy')->name('social-delete')->middleware(['permission:Social Delete']);

    });

    //Floor Master
    Route::group(['middleware' => ['permission:Floor Master'] ],function() {

        Route::get('/admin/floor/create', 'FloorController@create')->name('floor-create')->middleware(['permission:Floor Create']);
        Route::get('/admin/floor', 'FloorController@index')->name('floor-list')->middleware(['permission:Floor List']);
        Route::post('/admin/floor/store', 'FloorController@store')->name('floor-save')->middleware(['permission:Floor Create']);
        Route::get('/admin/floor/edit/{id}', 'FloorController@edit')->name('floor-edit')->middleware(['permission:Floor Edit']);
        Route::get('/admin/floor/view/{id}', 'FloorController@show')->name('floor-view')->middleware(['permission:Floor View']);
        Route::post('/admin/floor/update/{id}', 'FloorController@update')->name('floor-update')->middleware(['permission:Floor Update']);
        Route::get('/admin/floor/destroy/{id}', 'FloorController@destroy')->name('floor-delete')->middleware(['permission:Floor Delete']);

    });

    //Owner Master
    Route::group(['middleware' => ['permission:Owner Master'] ],function() {

        Route::get('/admin/owner/create', 'OwnerInfoController@create')->name('owner-create')->middleware(['permission:Owner Create']);
        Route::get('/admin/owner', 'OwnerInfoController@index')->name('owner-list')->middleware(['permission:Owner List']);
        Route::post('/admin/owner/store', 'OwnerInfoController@store')->name('owner-save')->middleware(['permission:Owner Create']);
        Route::get('/admin/owner/edit/{id}', 'OwnerInfoController@edit')->name('owner-edit')->middleware(['permission:Owner Edit']);
        Route::get('/admin/owner/view/{id}', 'OwnerInfoController@show')->name('owner-view')->middleware(['permission:Owner View']);
        Route::post('/admin/owner/update/{id}', 'OwnerInfoController@update')->name('owner-update')->middleware(['permission:Owner Update']);
        Route::get('/admin/owner/destroy/{id}', 'OwnerInfoController@destroy')->name('owner-delete')->middleware(['permission:Owner Delete']);
        Route::post('/admin/owner-parking/destroy', 'OwnerInfoController@parkingdestroy')->name('owner_parking-delete')->middleware(['permission:Owner Delete']);
        Route::post('/admin/owner-family/destroy', 'OwnerInfoController@familydestroy')->name('owner_family-delete')->middleware(['permission:Owner Delete']);
        Route::post('/admin/owner-nominee/destroy', 'OwnerInfoController@nomineedestroy')->name('owner_nominee-delete')->middleware(['permission:Owner Delete']);

    });


    //Owner Master
    Route::group(['middleware' => ['permission:Tenant Master'] ],function() {

        Route::get('/admin/tenantinfo/create', 'TenantInfoController@create')->name('tenantinfo-create')->middleware(['permission:Owner Create']);
        Route::get('/admin/tenantinfo', 'TenantInfoController@index')->name('tenantinfo-list')->middleware(['permission:Owner List']);
        Route::post('/admin/tenantinfo/store', 'TenantInfoController@store')->name('tenantinfo-save')->middleware(['permission:Owner Create']);
        Route::get('/admin/tenantinfo/edit/{id}', 'TenantInfoController@edit')->name('tenantinfo-edit')->middleware(['permission:Owner Edit']);
        Route::get('/admin/tenantinfo/view/{id}', 'TenantInfoController@show')->name('tenantinfo-view')->middleware(['permission:Owner View']);
        Route::post('/admin/tenantinfo/update/{id}', 'TenantInfoController@update')->name('tenantinfo-update')->middleware(['permission:Owner Update']);
        Route::get('/admin/tenantinfo/destroy/{id}', 'TenantInfoController@destroy')->name('tenantinfo-delete')->middleware(['permission:Owner Delete']);
        Route::post('/admin/tenantinfo-parking/destroy', 'TenantInfoController@parkingdestroy')->name('tenantinfo_parking-delete')->middleware(['permission:Owner Delete']);
        Route::post('/admin/tenantinfo-family/destroy', 'TenantInfoController@familydestroy')->name('tenantinfo_family-delete')->middleware(['permission:Owner Delete']);
        Route::post('/admin/tenantinfo-nominee/destroy', 'TenantInfoController@nomineedestroy')->name('tenantinfo_nominee-delete')->middleware(['permission:Owner Delete']);

    });


    //Unit Master
    Route::group(['middleware' => ['permission:Unit Master'] ],function() {

        Route::get('/admin/unit/create', 'UnitController@create')->name('unit-create')->middleware(['permission:Unit Create']);
        Route::get('/admin/unit', 'UnitController@index')->name('unit-list')->middleware(['permission:Unit List']);
        Route::post('/admin/unit/store', 'UnitController@store')->name('unit-save')->middleware(['permission:Unit Create']);
        Route::get('/admin/unit/edit/{id}', 'UnitController@edit')->name('unit-edit')->middleware(['permission:Unit Edit']);
        Route::get('/admin/unit/view/{id}', 'UnitController@show')->name('unit-view')->middleware(['permission:Unit View']);
        Route::post('/admin/unit/update/{id}', 'UnitController@update')->name('unit-update')->middleware(['permission:Unit Update']);
        Route::get('/admin/unit/destroy/{id}', 'UnitController@destroy')->name('unit-delete')->middleware(['permission:Unit Delete']);

    });

    //Plans Master
    Route::group(['middleware' => ['permission:Currency Master'] ],function() {
        Route::get('/admin/plan/create', 'PlanControllers@create')->name('plan-create')->middleware(['permission:Currency Create']);
        Route::get('/admin/plan/{type?}', 'PlanControllers@index')->name('plan-list')->middleware(['permission:Currency List']);
        Route::post('/admin/plan/store', 'PlanControllers@store')->name('plan-save')->middleware(['permission:Currency Create']);
        Route::get('/admin/plan/edit/{id}', 'PlanControllers@edit')->name('plan-edit')->middleware(['permission:Currency Edit']);
        Route::get('/admin/plan/view/{id}', 'PlanControllers@show')->name('plan-view')->middleware(['permission:Currency View']);
        Route::post('/admin/plan/update/{id}', 'PlanControllers@update')->name('plan-update')->middleware(['permission:Currency Update']);
        Route::post('/admin/plan/destroy/{id}', 'PlanControllers@destroy')->name('plan-delete')->middleware(['permission:Currency Delete']);
        Route::post('/admin/plan/restore/{id}', 'PlanControllers@restore')->name('plan-restore')->middleware(['permission:Currency Delete']);
    });


      //Tenant Master
      Route::group(['middleware' => ['permission:Tenant Master'] ],function() {

        Route::get('/admin/tenant/create', 'TenantController@create')->name('tenant-create')->middleware(['permission:Tenant Create']);
        Route::get('/admin/tenant', 'TenantController@index')->name('tenant-list')->middleware(['permission:Tenant List']);
        Route::post('/admin/tenant/store', 'TenantController@store')->name('tenant-save')->middleware(['permission:Tenant Create']);
        Route::get('/admin/tenant/edit/{id}', 'TenantController@edit')->name('tenant-edit')->middleware(['permission:Tenant Edit']);
        Route::get('/admin/tenant/view/{id}', 'TenantController@show')->name('tenant-view')->middleware(['permission:Tenant View']);
        Route::post('/admin/tenant/update/{id}', 'TenantController@update')->name('tenant-update')->middleware(['permission:Tenant Update']);
        Route::get('/admin/tenant/destroy/{id}', 'TenantController@destroy')->name('tenant-delete')->middleware(['permission:Tenant Delete']);
        Route::get('/admin/books/getunit', 'TenantController@getunit')->name('getunit')->middleware([]);
        Route::post('/admin/tenant-parking/destroy', 'TenantController@parkingdestroy')->name('tenant_parking-delete')->middleware(['permission:Tenant Delete']);
        Route::post('/admin/tenant-family/destroy', 'TenantController@familydestroy')->name('tenant_family-delete')->middleware(['permission:Tenant Delete']);

    });

        //Bill Master
        Route::group(['middleware' => ['permission:Bill Master'] ],function() {

            Route::get('/admin/bill/create', 'BillController@create')->name('bill-create')->middleware(['permission:Bill Create']);
            Route::get('/admin/bill', 'BillController@index')->name('bill-list')->middleware(['permission:Bill List']);
            Route::post('/admin/bill/store', 'BillController@store')->name('bill-save')->middleware(['permission:Bill Create']);
            Route::get('/admin/bill/edit/{id}', 'BillController@edit')->name('bill-edit')->middleware(['permission:Bill Edit']);
            Route::get('/admin/bill/view/{id}', 'BillController@show')->name('bill-view')->middleware(['permission:Bill View']);
            Route::post('/admin/bill/update/{id}', 'BillController@update')->name('bill-update')->middleware(['permission:Bill Update']);
            Route::get('/admin/bill/destroy/{id}', 'BillController@destroy')->name('bill-delete')->middleware(['permission:Bill Delete']);

        });

          //Fund Master
          Route::group(['middleware' => ['permission:Fund Master'] ],function() {

            Route::get('/admin/fund/create', 'FundController@create')->name('fund-create')->middleware(['permission:Fund Create']);
            Route::get('/admin/fund', 'FundController@index')->name('fund-list')->middleware(['permission:Fund List']);
            Route::post('/admin/fund/store', 'FundController@store')->name('fund-save')->middleware(['permission:Fund Create']);
            Route::get('/admin/fund/edit/{id}', 'FundController@edit')->name('fund-edit')->middleware(['permission:Fund Edit']);
            Route::get('/admin/fund/view/{id}', 'FundController@show')->name('fund-view')->middleware(['permission:Fund View']);
            Route::post('/admin/fund/update/{id}', 'FundController@update')->name('fund-update')->middleware(['permission:Fund Update']);
            Route::get('/admin/fund/destroy/{id}', 'FundController@destroy')->name('fund-delete')->middleware(['permission:Fund Delete']);

        });

          //Expenses Record Master
          Route::group(['middleware' => ['permission:Expenses Record Master'] ],function() {

            Route::get('/admin/expenses_record/create', 'Expenses_recordController@create')->name('expenses_record-create')->middleware(['permission:Expenses Record Create']);
            Route::get('/admin/expenses_record', 'Expenses_recordController@index')->name('expenses_record-list')->middleware(['permission:Expenses Record List']);
            Route::post('/admin/expenses_record/store', 'Expenses_recordController@store')->name('expenses_record-save')->middleware(['permission:Expenses Record Create']);
            Route::get('/admin/expenses_record/edit/{id}', 'Expenses_recordController@edit')->name('expenses_record-edit')->middleware(['permission:Expenses Record Edit']);
            Route::get('/admin/expenses_record/view/{id}', 'Expenses_recordController@show')->name('expenses_record-view')->middleware(['permission:Expenses Record View']);
            Route::post('/admin/expenses_record/update/{id}', 'Expenses_recordController@update')->name('expenses_record-update')->middleware(['permission:Expenses Record Update']);
            Route::get('/admin/expenses_record/destroy/{id}', 'Expenses_recordController@destroy')->name('expenses_record-delete')->middleware(['permission:Expenses Record Delete']);

        });


        //vendor Master
        Route::group(['middleware' => ['permission:Vendor Master'] ],function() {

            Route::get('/admin/vendor/create', 'VendorController@create')->name('vendor-create')->middleware(['permission:Vendor Create']);
            Route::get('/admin/vendor', 'VendorController@index')->name('vendor-list')->middleware(['permission:Vendor List']);
            Route::post('/admin/vendor/store', 'VendorController@store')->name('vendor-save')->middleware(['permission:Vendor Create']);
            Route::get('/admin/vendor/edit/{id}', 'VendorController@edit')->name('vendor-edit')->middleware(['permission:Vendor Edit']);
            Route::get('/admin/vendor/view/{id}', 'VendorController@show')->name('vendor-view')->middleware(['permission:Vendor View']);
            Route::post('/admin/vendor/update/{id}', 'VendorController@update')->name('vendor-update')->middleware(['permission:Vendor Update']);
            Route::get('/admin/vendor/destroy/{id}', 'VendorController@destroy')->name('vendor-delete')->middleware(['permission:Vendor Delete']);

        });


          //Complain Master
          Route::group(['middleware' => ['permission:Complain Master'] ],function() {

            Route::get('/admin/complain/create', 'ComplainController@create')->name('complain-create')->middleware(['permission:Complain Create']);
            Route::get('/admin/complain', 'ComplainController@index')->name('complain-list')->middleware(['permission:Complain List']);
            Route::post('/admin/complain/store', 'ComplainController@store')->name('complain-save')->middleware(['permission:Complain Create']);
            Route::get('/admin/complain/edit/{id}', 'ComplainController@edit')->name('complain-edit')->middleware(['permission:Complain Edit']);
            Route::get('/admin/complain/view/{id}', 'ComplainController@show')->name('complain-view')->middleware(['permission:Complain View']);
            Route::post('/admin/complain/update/{id}', 'ComplainController@update')->name('complain-update')->middleware(['permission:Complain Update']);
            Route::get('/admin/complain/destroy/{id}', 'ComplainController@destroy')->name('complain-delete')->middleware(['permission:Complain Delete']);

        });

         //Visitors Master
         Route::group(['middleware' => ['permission:Visitors Master'] ],function() {

            Route::get('/admin/visitors/create', 'VisitorsController@create')->name('visitors-create')->middleware(['permission:Visitors Create']);
            Route::get('/admin/visitors', 'VisitorsController@index')->name('visitors-list')->middleware(['permission:Visitors List']);
            Route::post('/admin/visitors/store', 'VisitorsController@store')->name('visitors-save')->middleware(['permission:Visitors Create']);
            Route::get('/admin/visitors/edit/{id}', 'VisitorsController@edit')->name('visitors-edit')->middleware(['permission:Visitors Edit']);
            Route::get('/admin/visitors/view/{id}', 'VisitorsController@show')->name('visitors-view')->middleware(['permission:Visitors View']);
            Route::post('/admin/visitors/update/{id}', 'VisitorsController@update')->name('visitors-update')->middleware(['permission:Visitors Update']);
            Route::get('/admin/visitors/destroy/{id}', 'VisitorsController@destroy')->name('visitors-delete')->middleware(['permission:Visitors Delete']);
            Route::post('/admin/visitors/update_outtime/{id}', 'VisitorsController@update_outtime')->name('visitors-update-outtime')->middleware(['permission:Visitors Update']);

        });

          //Meeting Master
          Route::group(['middleware' => ['permission:Meeting Master'] ],function() {

            Route::get('/admin/meeting/create', 'MeetingController@create')->name('meeting-create')->middleware(['permission:Meeting Create']);
            Route::get('/admin/meeting', 'MeetingController@index')->name('meeting-list')->middleware(['permission:Meeting List']);
            Route::post('/admin/meeting/store', 'MeetingController@store')->name('meeting-save')->middleware(['permission:Meeting Create']);
            Route::get('/admin/meeting/edit/{id}', 'MeetingController@edit')->name('meeting-edit')->middleware(['permission:Meeting Edit']);
            Route::get('/admin/meeting/view/{id}', 'MeetingController@show')->name('meeting-view')->middleware(['permission:Meeting View']);
            Route::post('/admin/meeting/update/{id}', 'MeetingController@update')->name('meeting-update')->middleware(['permission:Meeting Update']);
            Route::get('/admin/meeting/destroy/{id}', 'MeetingController@destroy')->name('meeting-delete')->middleware(['permission:Meeting Delete']);

        });

        // Setings Modules

        Route::group(['middleware' => ['permission:Admin Setup Master'] ],function() {

            Route::get('/admin/admin_setup/create', 'AdminSetupController@create')->name('admin_setup-create')->middleware(['permission:Admin Setup Create']);
            Route::get('/admin/admin_setup', 'AdminSetupController@index')->name('admin_setup-list')->middleware(['permission:Admin Setup List']);
            Route::post('/admin/admin_setup/store', 'AdminSetupController@store')->name('admin_setup-save')->middleware(['permission:Admin Setup Create']);
            Route::get('/admin/admin_setup/edit/{id}', 'AdminSetupController@edit')->name('admin_setup-edit')->middleware(['permission:Admin Setup Edit']);
            Route::get('/admin/admin_setup/view/{id}', 'AdminSetupController@show')->name('admin_setup-view')->middleware(['permission:Admin Setup View']);
            Route::post('/admin/admin_setup/update/{id}', 'AdminSetupController@update')->name('admin_setup-update')->middleware(['permission:Admin Setup Update']);
            Route::get('/admin/admin_setup/destroy/{id}', 'AdminSetupController@destroy')->name('admin_setup-delete')->middleware(['permission:Admin Setup Delete']);

        });

        Route::group(['middleware' => ['permission:Building Master'] ],function() {

            Route::get('/admin/building/create', 'BuildingController@create')->name('building-create')->middleware(['permission:Building Create']);
            Route::get('/admin/building', 'BuildingController@index')->name('building-list')->middleware(['permission:Building List']);
            Route::post('/admin/building/store', 'BuildingController@store')->name('building-save')->middleware(['permission:Building Create']);
            Route::get('/admin/building/edit/{id}', 'BuildingController@edit')->name('building-edit')->middleware(['permission:Building Edit']);
            Route::get('/admin/building/view/{id}', 'BuildingController@show')->name('building-view')->middleware(['permission:Building View']);
            Route::post('/admin/building/update/{id}', 'BuildingController@update')->name('building-update')->middleware(['permission:Building Update']);
            Route::get('/admin/building/destroy/{id}', 'BuildingController@destroy')->name('building-delete')->middleware(['permission:Building Delete']);

        });

        Route::group(['middleware' => ['permission:Bill Type Master'] ],function() {

            Route::get('/admin/bill_type/create', 'BillTypeController@create')->name('bill_type-create')->middleware(['permission:Bill Type Create']);
            Route::get('/admin/bill_type', 'BillTypeController@index')->name('bill_type-list')->middleware(['permission:Bill Type List']);
            Route::post('/admin/bill_type/store', 'BillTypeController@store')->name('bill_type-save')->middleware(['permission:Bill Type Create']);
            Route::get('/admin/bill_type/edit/{id}', 'BillTypeController@edit')->name('bill_type-edit')->middleware(['permission:Bill Type Edit']);
            Route::get('/admin/bill_type/view/{id}', 'BillTypeController@show')->name('bill_type-view')->middleware(['permission:Bill Type View']);
            Route::post('/admin/bill_type/update/{id}', 'BillTypeController@update')->name('bill_type-update')->middleware(['permission:Bill Type Update']);
            Route::get('/admin/bill_type/destroy/{id}', 'BillTypeController@destroy')->name('bill_type-delete')->middleware(['permission:Bill Type Delete']);

        });


        Route::group(['middleware' => ['permission:Utility Bill Master'] ],function() {

            Route::get('/admin/utility_bill/create', 'UtilityBillController@create')->name('utility_bill-create')->middleware(['permission:Utility Bill Create']);
            Route::get('/admin/utility_bill', 'UtilityBillController@index')->name('utility_bill-list')->middleware(['permission:Utility Bill List']);
            Route::post('/admin/utility_bill/store', 'UtilityBillController@store')->name('utility_bill-save')->middleware(['permission:Utility Bill Create']);
            Route::get('/admin/utility_bill/edit/{id}', 'UtilityBillController@edit')->name('utility_bill-edit')->middleware(['permission:Utility Bill Edit']);
            Route::get('/admin/utility_bill/view/{id}', 'UtilityBillController@show')->name('utility_bill-view')->middleware(['permission:Utility Bill View']);
            Route::post('/admin/utility_bill/update/{id}', 'UtilityBillController@update')->name('utility_bill-update')->middleware(['permission:Utility Bill Update']);
            Route::get('/admin/utility_bill/destroy/{id}', 'UtilityBillController@destroy')->name('utility_bill-delete')->middleware(['permission:Utility Bill Delete']);

        });

        Route::group(['middleware' => ['permission:Management Member Master'] ],function() {

            Route::get('/admin/management_member/create', 'ManagementMemberController@create')->name('management_member-create')->middleware(['permission:Management Member Create']);
            Route::get('/admin/management_member', 'ManagementMemberController@index')->name('management_member-list')->middleware(['permission:Management Member List']);
            Route::post('/admin/management_member/store', 'ManagementMemberController@store')->name('management_member-save')->middleware(['permission:Management Member Create']);
            Route::get('/admin/management_member/edit/{id}', 'ManagementMemberController@edit')->name('management_member-edit')->middleware(['permission:Management Member Edit']);
            Route::get('/admin/management_member/view/{id}', 'ManagementMemberController@show')->name('management_member-view')->middleware(['permission:Management Member View']);
            Route::post('/admin/management_member/update/{id}', 'ManagementMemberController@update')->name('management_member-update')->middleware(['permission:Management Member Update']);
            Route::get('/admin/management_member/destroy/{id}', 'ManagementMemberController@destroy')->name('management_member-delete')->middleware(['permission:Management Member Delete']);

        });

        Route::group(['middleware' => ['permission:Month Master'] ],function() {

            Route::get('/admin/month/create', 'MonthController@create')->name('month-create')->middleware(['permission:Month Create']);
            Route::get('/admin/month', 'MonthController@index')->name('month-list')->middleware(['permission:Month List']);
            Route::post('/admin/month/store', 'MonthController@store')->name('month-save')->middleware(['permission:Month Create']);
            Route::get('/admin/month/edit/{id}', 'MonthController@edit')->name('month-edit')->middleware(['permission:Month Edit']);
            Route::get('/admin/month/view/{id}', 'MonthController@show')->name('month-view')->middleware(['permission:Month View']);
            Route::post('/admin/month/update/{id}', 'MonthController@update')->name('month-update')->middleware(['permission:Month Update']);
            Route::get('/admin/month/destroy/{id}', 'MonthController@destroy')->name('month-delete')->middleware(['permission:Month Delete']);

        });

        Route::group(['middleware' => ['permission:Year Master'] ],function() {

            Route::get('/admin/year/create', 'YearController@create')->name('year-create')->middleware(['permission:Year Create']);
            Route::get('/admin/year', 'YearController@index')->name('year-list')->middleware(['permission:Year List']);
            Route::any('/admin/year/store', 'YearController@store')->name('year-save')->middleware(['permission:Year Create']);
            Route::get('/admin/year/edit/{id}', 'YearController@edit')->name('year-edit')->middleware(['permission:Year Edit']);
            Route::get('/admin/year/view/{id}', 'YearController@show')->name('year-view')->middleware(['permission:Year View']);
            Route::post('/admin/year/update/{id}', 'YearController@update')->name('year-update')->middleware(['permission:Year Update']);
            Route::get('/admin/year/destroy/{id}', 'YearController@destroy')->name('year-delete')->middleware(['permission:Year Delete']);

        });

        Route::group(['middleware' => ['permission:Currency Master'] ],function() {

            Route::get('/admin/currency/create', 'CurrencyController@create')->name('currency-create')->middleware(['permission:Currency Create']);
            Route::get('/admin/currency', 'CurrencyController@index')->name('currency-list')->middleware(['permission:Currency List']);
            Route::post('/admin/currency/store', 'CurrencyController@store')->name('currency-save')->middleware(['permission:Currency Create']);
            Route::get('/admin/currency/edit/{id}', 'CurrencyController@edit')->name('currency-edit')->middleware(['permission:Currency Edit']);
            Route::get('/admin/currency/view/{id}', 'CurrencyController@show')->name('currency-view')->middleware(['permission:Currency View']);
            Route::post('/admin/currency/update/{id}', 'CurrencyController@update')->name('currency-update')->middleware(['permission:Currency Update']);
            Route::get('/admin/currency/destroy/{id}', 'CurrencyController@destroy')->name('currency-delete')->middleware(['permission:Currency Delete']);

        });

        Route::group(['middleware' => ['permission:Currency Master'] ],function() {

            Route::get('/admin/country/create', 'CountryController@create')->name('country-create')->middleware(['permission:Currency Create']);
            Route::get('/admin/country', 'CountryController@index')->name('country-list')->middleware(['permission:Currency List']);
            Route::post('/admin/country/store', 'CountryController@store')->name('country-save')->middleware(['permission:Currency Create']);
            Route::get('/admin/country/edit/{id}', 'CountryController@edit')->name('country-edit')->middleware(['permission:Currency Edit']);
            Route::get('/admin/country/view/{id}', 'CountryController@show')->name('country-view')->middleware(['permission:Currency View']);
            Route::post('/admin/country/update/{id}', 'CountryController@update')->name('country-update')->middleware(['permission:Currency Update']);
            Route::get('/admin/country/destroy/{id}', 'CountryController@destroy')->name('country-delete')->middleware(['permission:Currency Delete']);

        });





         //Notice Master
         Route::group(['middleware' => ['permission:Notice Master'] ],function() {
            //employee
            Route::get('/admin/employee_notice/create', 'NoticeController@employee_create')->name('employee_notice-create')->middleware(['permission:Notice Create']);
            Route::get('/admin/employee_notice', 'NoticeController@employee_index')->name('employee_notice-list')->middleware(['permission:Notice List']);
            Route::post('/admin/employee_notice/store', 'NoticeController@employee_store')->name('employee_notice-save')->middleware(['permission:Notice Create']);
            Route::get('/admin/employee_notice/edit/{id}', 'NoticeController@employee_edit')->name('employee_notice-edit')->middleware(['permission:Notice Edit']);
            Route::get('/admin/employee_notice/view/{id}', 'NoticeController@employee_show')->name('employee_notice-view')->middleware(['permission:Notice View']);
            Route::post('/admin/employee_notice/update/{id}', 'NoticeController@employee_update')->name('employee_notice-update')->middleware(['permission:Notice Update']);
            Route::get('/admin/employee_notice/destroy/{id}', 'NoticeController@employee_destroy')->name('employee_notice-delete')->middleware(['permission:Notice Delete']);
            //tenant

            Route::get('/admin/tenant_notice/create', 'NoticeController@tenant_create')->name('tenant_notice-create')->middleware(['permission:Notice Create']);
            Route::get('/admin/tenant_notice', 'NoticeController@tenant_index')->name('tenant_notice-list')->middleware(['permission:Notice List']);
            Route::post('/admin/tenant_notice/store', 'NoticeController@tenant_store')->name('tenant_notice-save')->middleware(['permission:Notice Create']);
            Route::get('/admin/tenant_notice/edit/{id}', 'NoticeController@tenant_edit')->name('tenant_notice-edit')->middleware(['permission:Notice Edit']);
            Route::get('/admin/tenant_notice/view/{id}', 'NoticeController@tenant_show')->name('tenant_notice-view')->middleware(['permission:Notice View']);
            Route::post('/admin/tenant_notice/update/{id}', 'NoticeController@tenant_update')->name('tenant_notice-update')->middleware(['permission:Notice Update']);
            Route::get('/admin/tenant_notice/destroy/{id}', 'NoticeController@tenant_destroy')->name('tenant_notice-delete')->middleware(['permission:Notice Delete']);

            //owner

            Route::get('/admin/owner_notice/create', 'NoticeController@owner_create')->name('owner_notice-create')->middleware(['permission:Notice Create']);
            Route::get('/admin/owner_notice', 'NoticeController@owner_index')->name('owner_notice-list')->middleware(['permission:Notice List']);
            Route::post('/admin/owner_notice/store', 'NoticeController@owner_store')->name('owner_notice-save')->middleware(['permission:Notice Create']);
            Route::get('/admin/owner_notice/edit/{id}', 'NoticeController@owner_edit')->name('owner_notice-edit')->middleware(['permission:Notice Edit']);
            Route::get('/admin/owner_notice/view/{id}', 'NoticeController@owner_show')->name('owner_notice-view')->middleware(['permission:Notice View']);
            Route::post('/admin/owner_notice/update/{id}', 'NoticeController@owner_update')->name('owner_notice-update')->middleware(['permission:Notice Update']);
            Route::get('/admin/owner_notice/destroy/{id}', 'NoticeController@owner_destroy')->name('owner_notice-delete')->middleware(['permission:Notice Delete']);

        });

      //Rent Master
      Route::group(['middleware' => ['permission:Rent Master'] ],function() {

        Route::get('/admin/rent/create', 'RentController@create')->name('rent-create')->middleware(['permission:Rent Create']);
        Route::get('/admin/rent', 'RentController@index')->name('rent-list')->middleware(['permission:Rent List']);
        Route::post('/admin/rent/store', 'RentController@store')->name('rent-save')->middleware(['permission:Rent Create']);
        Route::get('/admin/rent/edit/{id}', 'RentController@edit')->name('rent-edit')->middleware(['permission:Rent Edit']);
        Route::get('/admin/rent/view/{id}', 'RentController@show')->name('rent-view')->middleware(['permission:Rent View']);
        Route::post('/admin/rent/update/{id}', 'RentController@update')->name('rent-update')->middleware(['permission:Rent Update']);
        Route::get('/admin/rent/destroy/{id}', 'RentController@destroy')->name('rent-delete')->middleware(['permission:Rent Delete']);

    });



      //Maintenance Cost Master
      Route::group(['middleware' => ['permission:MaintenanceCost Master'] ],function() {

        Route::get('/admin/maintenanceCost/create', 'MaintenanceCostController@create')->name('maintenanceCost-create')->middleware(['permission:MaintenanceCost Create']);
        Route::get('/admin/maintenanceCost', 'MaintenanceCostController@index')->name('maintenanceCost-list')->middleware(['permission:MaintenanceCost List']);
        Route::post('/admin/maintenanceCost/store', 'MaintenanceCostController@store')->name('maintenanceCost-save')->middleware(['permission:MaintenanceCost Create']);
        Route::get('/admin/maintenanceCost/edit/{id}', 'MaintenanceCostController@edit')->name('maintenanceCost-edit')->middleware(['permission:MaintenanceCost Edit']);
        Route::get('/admin/maintenanceCost/view/{id}', 'MaintenanceCostController@show')->name('maintenanceCost-view')->middleware(['permission:MaintenanceCost View']);
        Route::post('/admin/maintenanceCost/update/{id}', 'MaintenanceCostController@update')->name('maintenanceCost-update')->middleware(['permission:MaintenanceCost Update']);
        Route::get('/admin/maintenanceCost/destroy/{id}', 'MaintenanceCostController@destroy')->name('maintenanceCost-delete')->middleware(['permission:MaintenanceCost Delete']);

    });


        //Management Committee Master
        Route::group(['middleware' => ['permission:ManagementCommittee Master'] ],function() {

        Route::get('/admin/management_committee/create', 'ManagementCommitteeController@create')->name('management_committee-create')->middleware(['permission:ManagementCommittee Create']);
        Route::get('/admin/management_committee', 'ManagementCommitteeController@index')->name('management_committee-list')->middleware(['permission:ManagementCommittee List']);
        Route::post('/admin/management_committee/store', 'ManagementCommitteeController@store')->name('management_committee-save')->middleware(['permission:ManagementCommittee Create']);
        Route::get('/admin/management_committee/edit/{id}', 'ManagementCommitteeController@edit')->name('management_committee-edit')->middleware(['permission:ManagementCommittee Edit']);
        Route::get('/admin/management_committee/view/{id}', 'ManagementCommitteeController@show')->name('management_committee-view')->middleware(['permission:ManagementCommittee View']);
        Route::post('/admin/management_committee/update/{id}', 'ManagementCommitteeController@update')->name('management_committee-update')->middleware(['permission:ManagementCommittee Update']);
        Route::get('/admin/management_committee/destroy/{id}', 'ManagementCommitteeController@destroy')->name('management_committee-delete')->middleware(['permission:ManagementCommittee Delete']);

        Route::get('/admin/management_committee/group-create', 'ManagementCommitteeController@group_create')->name('management_committee-group_create')->middleware(['permission:ManagementCommittee Group Create']);
        Route::post('/admin/management_committee/group-store', 'ManagementCommitteeController@group_store')->name('management_committee-group_save')->middleware(['permission:ManagementCommittee Group Create']);

    });

    //Employee Information
    Route::group(['middleware' => ['permission:Employee Master'] ],function() {

        Route::get('/admin/employee/create', 'EmployeeInfoController@create')->name('employee-create')->middleware(['permission:Employee Create']);
        Route::get('/admin/employee', 'EmployeeInfoController@index')->name('employee-list')->middleware(['permission:Employee List']);
        Route::post('/admin/employee/store', 'EmployeeInfoController@store')->name('employee-save')->middleware(['permission:Employee Create']);
        Route::get('/admin/employee/edit/{id}', 'EmployeeInfoController@edit')->name('employee-edit')->middleware(['permission:Employee Edit']);
        Route::get('/admin/employee/view/{id}', 'EmployeeInfoController@show')->name('employee-view')->middleware(['permission:Employee View']);
        Route::post('/admin/employee/update/{id}', 'EmployeeInfoController@update')->name('employee-update')->middleware(['permission:Employee Update']);
        Route::any('/admin/employee/destroy/{id}', 'EmployeeInfoController@destroy')->name('employee-delete')->middleware(['permission:Employee Delete']);

    });

    //Notification Master
    Route::group(['middleware' => ['permission:Notifications Master'] ],function() {

        Route::get('/admin/notification-list', 'NotificationController@index')->name('notification-list')->middleware(['permission:Notifications List']);
        Route::get('/admin/notification/create', 'NotificationController@create')->name('notification-create')->middleware(['permission:Notifications Create']);
        Route::post('/admin/notification/store', 'NotificationController@store')->name('notification-store')->middleware(['permission:Notifications Create']);
    });

     //Employee Salary
     Route::group(['middleware' => ['permission:Employee_Salary Master'] ],function() {

        Route::get('/admin/employee_salary/create', 'EmployeeInfoController@salary_create')->name('employee_salary-create')->middleware(['permission:Employee_Salary Create']);
        Route::get('/admin/employee_salary', 'EmployeeInfoController@salary_index')->name('employee_salary-list')->middleware(['permission:Employee_Salary List']);
        Route::post('/admin/employee_salary/store', 'EmployeeInfoController@salary_store')->name('employee_salary-save')->middleware(['permission:Employee_Salary Create']);
        Route::get('/admin/employee_salary/edit/{id}', 'EmployeeInfoController@salary_edit')->name('employee_salary-edit')->middleware(['permission:Employee_Salary Edit']);
        Route::get('/admin/employee_salary/view/{id}', 'EmployeeInfoController@salary_show')->name('employee_salary-view')->middleware(['permission:Employee_Salary View']);
        Route::post('/admin/employee_salary/update/{id}', 'EmployeeInfoController@salary_update')->name('employee_salary-update')->middleware(['permission:Employee_Salary Update']);
        Route::any('/admin/employee_salary/destroy/{id}', 'EmployeeInfoController@salary_destroy')->name('employee_salary-delete')->middleware(['permission:Employee_Salary Delete']);
        Route::get('/admin/employee_leave', 'EmployeeInfoController@leave_index')->name('employee_leave-list')->middleware(['permission:Employee_Leave List']);

    });


      //Owner Utility
      Route::group(['middleware' => ['permission:Utility Master'] ],function() {

        Route::get('/admin/owner_utility/create', 'OwnerInfoController@utility_create')->name('owner_utility-create')->middleware(['permission:Utility Create']);
        Route::get('/admin/owner_utility', 'OwnerInfoController@utility_index')->name('owner_utility-list')->middleware(['permission:Utility List']);
        Route::post('/admin/owner_utility/store', 'OwnerInfoController@utility_store')->name('owner_utility-save')->middleware(['permission:Utility Create']);
        Route::get('/admin/owner_utility/edit/{id}', 'OwnerInfoController@utility_edit')->name('owner_utility-edit')->middleware(['permission:Utility Edit']);
        Route::get('/admin/owner_utility/view/{id}', 'OwnerInfoController@utility_show')->name('owner_utility-view')->middleware(['permission:Utility View']);
        Route::post('/admin/owner_utility/update/{id}', 'OwnerInfoController@utility_update')->name('owner_utility-update')->middleware(['permission:Utility Update']);
        Route::any('/admin/owner_utility/destroy/{id}', 'OwnerInfoController@utility_destroy')->name('owner_utility-delete')->middleware(['permission:Utility Delete']);

    });

    //Service Master
    Route::group(['middleware' => ['permission:Service Master'] ],function() {

        Route::get('/admin/service/create', 'ServiceController@create')->name('service-create')->middleware(['permission:Service Create']);
        Route::get('/admin/service', 'ServiceController@index')->name('service-list')->middleware(['permission:Service List']);
        Route::post('/admin/service/store', 'ServiceController@store')->name('service-save')->middleware(['permission:Service Create']);
        Route::get('/admin/service/edit/{id}', 'ServiceController@edit')->name('service-edit')->middleware(['permission:Service Edit']);
        Route::get('/admin/service/view/{id}', 'ServiceController@show')->name('service-view')->middleware(['permission:Service View']);
        Route::post('/admin/service/update/{id}', 'ServiceController@update')->name('service-update')->middleware(['permission:Service Update']);
        Route::post('/admin/service/destroy/{id}', 'ServiceController@destroy')->name('service-delete')->middleware(['permission:Service Delete']);

    });

      //event Master
    Route::group(['middleware' => ['permission:Event Master']], function() {
        Route::get('/admin/event-list', 'EventController@index')->name('event-list')->middleware(['permission:Event List']);
        Route::get('/admin/event/create', 'EventController@create')->name('event-create')->middleware(['permission:Event Create']);
        Route::post('/admin/event/store', 'EventController@store')->name('event-save')->middleware(['permission:Event Create']);
        Route::get('/admin/event/edit/{id}', 'EventController@edit')->name('event-edit')->middleware(['permission:Event Edit']);
        Route::post('/admin/event/update/{id}', 'EventController@update')->name('event-update')->middleware(['permission:Event Edit']);
        Route::get('/admin/event/delete/{id}', 'EventController@destroy')->name('event-delete')->middleware(['permission:Event Delete']);
        Route::get('/admin/event/view/{id}', 'EventController@show')->name('event-view')->middleware(['permission:Event View']);
    });


    //Banner Master
    Route::group(['middleware' => ['permission:Banner Master'] ],function() {

        Route::get('/admin/banner/create', 'BannerController@create')->name('banner-create')->middleware(['permission:Banner Create']);
        Route::get('/admin/banner', 'BannerController@index')->name('banner-list')->middleware(['permission:Banner List']);
        Route::post('/admin/banner/store', 'BannerController@store')->name('banner-save')->middleware(['permission:Banner Create']);
        Route::get('/admin/banner/edit/{id}', 'BannerController@edit')->name('banner-edit')->middleware(['permission:Banner Edit']);
        Route::get('/admin/banner/view/{id}', 'BannerController@show')->name('banner-view')->middleware(['permission:Banner View']);
        Route::post('/admin/banner/update/{id}', 'BannerController@update')->name('banner-update')->middleware(['permission:Banner Update']);
        Route::post('/admin/banner/destroy/{id}', 'BannerController@destroy')->name('banner-delete')->middleware(['permission:Banner Delete']);

    });


     //Service Admin Master
     Route::group(['middleware' => ['permission:Service Admin Master'] ],function() {

        Route::get('/admin/service_admin/create', 'ServiceAdminController@create')->name('service_admin-create')->middleware(['permission:Service Admin Create']);
        Route::get('/admin/service_admin', 'ServiceAdminController@index')->name('service_admin-list')->middleware(['permission:Service Admin List']);
        Route::post('/admin/service_admin/store', 'ServiceAdminController@store')->name('service_admin-save')->middleware(['permission:Service Admin Create']);
        Route::get('/admin/service_admin/edit/{id}', 'ServiceAdminController@edit')->name('service_admin-edit')->middleware(['permission:Service Admin Edit']);
        Route::get('/admin/service_admin/view/{id}', 'ServiceAdminController@show')->name('service_admin-view')->middleware(['permission:Service Admin View']);
        Route::post('/admin/service_admin/update/{id}', 'ServiceAdminController@update')->name('service_admin-update')->middleware(['permission:Service Admin Update']);
        Route::post('/admin/service_admin/destroy/{id}', 'ServiceAdminController@destroy')->name('service_admin-delete')->middleware(['permission:Service Admin Delete']);

    });

    //Society Master
    Route::group(['middleware' => ['permission:Society Master'] ],function() {

        Route::get('/admin/society/create', 'SocietyController@create')->name('society-create')->middleware(['permission:Society Create']);
        Route::get('/admin/society', 'SocietyController@index')->name('society-list')->middleware(['permission:Society List']);
        Route::post('/admin/society/store', 'SocietyController@store')->name('society-save')->middleware(['permission:Society Create']);
        Route::get('/admin/society/edit/{id}', 'SocietyController@edit')->name('society-edit')->middleware(['permission:Society Edit']);
        Route::get('/admin/society/view/{id}', 'SocietyController@show')->name('society-view')->middleware(['permission:Society View']);

        Route::post('/admin/society/update/{id}', 'SocietyController@update')->name('society-update')->middleware(['permission:Society Update']);
        Route::post('/admin/society/update/committe/{id}', 'SocietyController@committeUpdate')->name('society-committe-member-update')->middleware(['permission:Society Update']);
        Route::post('/admin/society/update/members/{id}', 'SocietyController@societyMemberupdate')->name('society-member-update')->middleware(['permission:Society Update']);
        Route::post('/admin/society/update/parkings/{id}', 'SocietyController@societyParkingupdate')->name('society-parking-update')->middleware(['permission:Society Update']);
        Route::post('/admin/society/update/workers/{id}', 'SocietyController@societyWorkersupdate')->name('society-workers-update')->middleware(['permission:Society Update']);
        Route::post('/admin/society/update/security/{id}', 'SocietyController@societySecurityupdate')->name('society-security-update')->middleware(['permission:Society Update']);

        Route::post('/admin/society/destroy/{id}', 'SocietyController@destroy')->name('society-delete')->middleware(['permission:Society Delete']);

    });



    //Roles

    Route::get('/admin/role/create', 'RoleController@create')->name('role-create');
    Route::get('/admin/role', 'RoleController@index')->name('role-list');
    Route::post('/admin/role/store', 'RoleController@store')->name('role-save');
    Route::get('/admin/role/edit/{id}', 'RoleController@edit')->name('role-edit');
    Route::post('/admin/role/update/{id}', 'RoleController@update')->name('role-update');
    Route::post('/admin/role/destroy/{id}', 'RoleController@destroy')->name('role-delete');

    Route::get('/admin/permission/create', 'PermissionController@create')->name('permission-create');
    Route::get('/admin/permission', 'PermissionController@index')->name('permission-list');
    Route::post('/admin/permission/store', 'PermissionController@store')->name('permission-save');
    Route::get('/admin/permission/edit/{id}', 'PermissionController@edit')->name('permission-edit');
    Route::post('/admin/permission/update/{id}', 'PermissionController@update')->name('permission-update');
    Route::post('/admin/permission/destroy/{id}', 'PermissionController@destroy')->name('permission-delete');




});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
