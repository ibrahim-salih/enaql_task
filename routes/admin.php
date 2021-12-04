<?php

use App\Http\Controllers\Admin\Account\AccountController;
use App\Http\Controllers\Admin\ApprovalAuthority\ApprovalAuthorityController;
use App\Http\Controllers\Admin\City\CityController;
use App\Http\Controllers\Admin\Client\ClientController;
use App\Http\Controllers\Admin\ClientPaymentNotification\ClientPaymentNotificationController;
use App\Http\Controllers\Admin\Company\CompanyController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Department\DepartmentController;
use App\Http\Controllers\Admin\Designation\DesignationController;
use App\Http\Controllers\Admin\Driver\DriverController;
use App\Http\Controllers\Admin\DriverCountOrder\DriverCountOrderController;
use App\Http\Controllers\Admin\DriverPerformance\DriverPerformanceController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Expense\ExpenseController;
use App\Http\Controllers\Admin\FuelType\FuelTypeController;
use App\Http\Controllers\Admin\Insurance\InsuranceController;
use App\Http\Controllers\Admin\LicenseType\LicenseTypeController;
use App\Http\Controllers\Admin\Location\LocationController;
use App\Http\Controllers\Admin\MaintenanceType\MaintenanceTypeController;
use App\Http\Controllers\Admin\Office\OfficeController;
use App\Http\Controllers\Admin\PartCategory\PartCategoryController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\PickDropRequisition\PickDropRequisitionController;
use App\Http\Controllers\Admin\Remainder\RemainderController;
use App\Http\Controllers\Admin\Requisition\RequisitionController;
use App\Http\Controllers\Admin\RequisitionType\RequisitionTypeController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\Route\RouteController;
use App\Http\Controllers\Admin\Station\StationController;
use App\Http\Controllers\Admin\TripType\TripTypeController;
use App\Http\Controllers\Admin\Vehicle\VehicleController;
use App\Http\Controllers\Admin\VehicleDivision\VehicleDivisionController;
use App\Http\Controllers\Admin\VehicleType\VehicleTypeController;
use App\Http\Controllers\Admin\Vendor\VendorController;
use App\Http\Controllers\Admin\Maintenance\MaintenanceController;
use App\Http\Controllers\Admin\ManageClientPayment\ManageClientPaymentController;
use App\Http\Controllers\Admin\ManageIncome\ManageIncomeController;
use App\Http\Controllers\Admin\Part\PartController;
use App\Http\Controllers\Admin\PriceControl\PriceControlController;
use App\Http\Controllers\Admin\Purchase\PurchaseController;
use App\Http\Controllers\Admin\Purpose\PurposeController;
use App\Http\Controllers\Admin\RefuelingRequisition\RefuelingRequisitionController;
use App\Http\Controllers\Admin\RefuelSetting\RefuelSettingController;
use App\Http\Controllers\Admin\Requisition\HandleRequisitionStatus;
use App\Http\Controllers\Admin\RequisitionData\RequisitionDataController;
use App\Http\Controllers\Admin\SystemSetting\SystemSettingController;
use App\Models\ClientPaymentNotification;
use Illuminate\Support\Facades\Route;


Route::prefix(LaravelLocalization::setLocale())->group(function(){

    /*
    |--------------------------------------------------------------------------
    | Start Auth Routes
    |--------------------------------------------------------------------------
    */
    Route::redirect('/', '/login', 301);
    Auth::routes();

    /*
    |--------------------------------------------------------------------------
    | End Auth Routes
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Start Locale Routes
    |--------------------------------------------------------------------------
    */

    Route::post('set-locale' , [DashboardController::class , 'setLocale'])->name('set-locale');

    /*
    |--------------------------------------------------------------------------
    | End Locale Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth')->group(function(){

        /*
        |--------------------------------------------------------------------------
        | Start Dashboard Routes
        |--------------------------------------------------------------------------
        */

        Route::get('dashboard' , [DashboardController::class , 'index'])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | End Dashboard Routes
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Start Role Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('role' , RoleController::class);
        Route::get('role-datatable' , [RoleController::class , 'datatable'])->name('role.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Role Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Permission Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('permission' , PermissionController::class);
        Route::get('permission-datatable' , [PermissionController::class , 'datatable'])->name('permission.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Permission Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Designation Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('designation' , DesignationController::class);
        Route::get('designation-datatable' , [DesignationController::class , 'datatable'])->name('designation.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Designation Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Purpose Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('purpose' , PurposeController::class);
        Route::get('purpose-datatable' , [PurposeController::class , 'datatable'])->name('purpose.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Purpose Routes
        |--------------------------------------------------------------------------
        */





        /*
        |--------------------------------------------------------------------------
        | Start Requisition Type Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('requisition-type' , RequisitionTypeController::class);
        Route::get('requisition-type-datatable' , [RequisitionTypeController::class , 'datatable'])->name('requisition-type.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Requisition Type Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start City Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('city' , CityController::class);
        Route::get('city-datatable' , [CityController::class , 'datatable'])->name('city.datatable');

        /*
        |--------------------------------------------------------------------------
        | End City Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Department Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('department' , DepartmentController::class);
        Route::get('department-datatable' , [DepartmentController::class , 'datatable'])->name('department.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Department Routes
        |--------------------------------------------------------------------------
        */





        /*
        |--------------------------------------------------------------------------
        | Start Vehicle Type Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('vehicle-type' , VehicleTypeController::class);
        Route::get('vehicle-type-datatable' , [VehicleTypeController::class , 'datatable'])->name('vehicle-type.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Vehicle Type Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Vehicle Division Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('vehicle-division' , VehicleDivisionController::class);
        Route::get('vehicle-division-datatable' , [VehicleDivisionController::class , 'datatable'])->name('vehicle-division.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Vehicle Division Routes
        |--------------------------------------------------------------------------
        */





        /*
        |--------------------------------------------------------------------------
        | Start Office Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('office' , OfficeController::class);
        Route::get('office-datatable' , [OfficeController::class , 'datatable'])->name('office.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Office Routes
        |--------------------------------------------------------------------------
        */





        /*
        |--------------------------------------------------------------------------
        | Start Vendor Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('vendor' , VendorController::class);
        Route::get('vendor-datatable' , [VendorController::class , 'datatable'])->name('vendor.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Vendor Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Company Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('company' , CompanyController::class);
        Route::get('company-datatable' , [CompanyController::class , 'datatable'])->name('company.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Company Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start License Type Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('license-type' , LicenseTypeController::class);
        Route::get('license-type-datatable' , [LicenseTypeController::class , 'datatable'])->name('license-type.datatable');

        /*
        |--------------------------------------------------------------------------
        | End License Type Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Maintenance Type Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('maintenance-type' , MaintenanceTypeController::class);
        Route::get('maintenance-type-datatable' , [MaintenanceTypeController::class , 'datatable'])->name('maintenance-type.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Maintenance Type Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Trip Type Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('trip-type' , TripTypeController::class);
        Route::get('trip-type-datatable' , [TripTypeController::class , 'datatable'])->name('trip-type.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Trip Type Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start  Part Category Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('part-category' , PartCategoryController::class);
        Route::get('part-category-datatable' , [PartCategoryController::class , 'datatable'])->name('part-category.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Part Category Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start location Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('location' , LocationController::class);
        Route::get('location-datatable' , [LocationController::class , 'datatable'])->name('location.datatable');

        /*
        |--------------------------------------------------------------------------
        | End location Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Price Control Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('price-control' , PriceControlController::class);
        Route::get('price-control-datatable' , [PriceControlController::class , 'datatable'])->name('price-control.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Price Control Routes
        |--------------------------------------------------------------------------
        */






        /*
        |--------------------------------------------------------------------------
        | Start Fuel Type Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('fuel-type' , FuelTypeController::class);
        Route::get('fuel-type-datatable' , [FuelTypeController::class , 'datatable'])->name('fuel-type.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Fuel Type Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Stations Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('station' , StationController::class);
        Route::get('station-datatable' , [StationController::class , 'datatable'])->name('station.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Stations Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Employee Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('employee' , EmployeeController::class);
        Route::get('employee-datatable' , [EmployeeController::class , 'datatable'])->name('employee.datatable');

//        Route::group(['middleware' => ['auth']], function() {
//            Route::resource('roles','RoleController');
//            Route::resource('users','UserController');
//        });
        /*
        |--------------------------------------------------------------------------
        | End Employee Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Driver Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('driver' , DriverController::class);
        Route::get('driver-datatable' , [DriverController::class , 'datatable'])->name('driver.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Driver Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Driver Performance Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('driver-performance' , DriverPerformanceController::class);
        Route::get('driver-performance-datatable' , [DriverPerformanceController::class , 'datatable'])->name('driver-performance.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Driver Performance Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Vehicle Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('vehicle' , VehicleController::class);
        Route::get('vehicle-datatable' , [VehicleController::class , 'datatable'])->name('vehicle.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Vehicle Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Insurance Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('insurance' , InsuranceController::class);
        Route::get('insurance-datatable' , [InsuranceController::class , 'datatable'])->name('insurance.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Insurance Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Remainder Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('remainder' , RemainderController::class);
        Route::get('remainder-datatable' , [RemainderController::class , 'datatable'])->name('remainder.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Remainder Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Requisition Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('requisition' , RequisitionController::class);
        Route::get('receive_requisition/{id}' , [RequisitionController::class,'receive_requisition'])->name('admin.requisition.receive_requisition');
        Route::post('receive_requisition/{id}' , [RequisitionController::class,'receive_requisition_post'])->name('receive_requisition_post');
        Route::get('requisition-datatable' , [RequisitionController::class , 'datatable'])->name('requisition.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Requisition Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Route Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('route' , RouteController::class);
        Route::get('route-datatable' , [RouteController::class , 'datatable'])->name('route.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Route Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Approval Authority Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('approval-authority' , ApprovalAuthorityController::class);
        Route::get('approval-authority-datatable' , [ApprovalAuthorityController::class , 'datatable'])->name('approval-authority.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Approval Authority Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Pick Drop Requisition Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('pick-drop-requisition' , PickDropRequisitionController::class);
        Route::get('pick-drop-requisition-datatable' , [PickDropRequisitionController::class , 'datatable'])->name('pick-drop-requisition.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Pick Drop Requisition Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Maintenance Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('maintenance' , MaintenanceController::class);
        Route::get('maintenance-datatable' , [MaintenanceController::class , 'datatable'])->name('maintenance.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Maintenance Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Expense Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('expense' , ExpenseController::class);
        Route::get('expense-datatable' , [ExpenseController::class , 'datatable'])->name('expense.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Expense Routes
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Start Part Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('part' , PartController::class);
        Route::get('part-datatable' , [PartController::class , 'datatable'])->name('part.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Part Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Purchase Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('purchase' , PurchaseController::class);
        Route::get('purchase-datatable' , [PurchaseController::class , 'datatable'])->name('purchase.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Purchase Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Refuel Setting Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('refuel-setting' , RefuelSettingController::class);
        Route::get('refuel-setting-datatable' , [RefuelSettingController::class , 'datatable'])->name('refuel-setting.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Refuel Setting Routes
        |--------------------------------------------------------------------------
        */




        /*
        |--------------------------------------------------------------------------
        | Start Refueling Requisition Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('refueling-requisition' , RefuelingRequisitionController::class);
        Route::get('refueling-requisition-datatable' , [RefuelingRequisitionController::class , 'datatable'])->name('refueling-requisition.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Refueling Requisition Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Account Routes
        |--------------------------------------------------------------------------
        */

        Route::get('my-account' , [AccountController::class , 'index']);
        Route::post('my-account' , [AccountController::class , 'update'])->name('my-account.update');

        /*
        |--------------------------------------------------------------------------
        | End Account Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Client Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('client' , ClientController::class);
        Route::get('client-datatable' , [ClientController::class , 'datatable'])->name('client.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Client Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Handle Requisition Status Routes
        |--------------------------------------------------------------------------
        */

        Route::get('requisition-admin-accept' , [HandleRequisitionStatus::class , 'AdminAccept'])->name('requisition-admin-accept');
        Route::get('requisition-admin-ask-for-edit' , [HandleRequisitionStatus::class , 'AdminAskForEdit'])->name('requisition-admin-ask-for-edit');
        Route::get('requisition-client-track' , [HandleRequisitionStatus::class , 'ClientTrackRequisition'])->name('requisition-client-track');
        Route::post('requisition-client-accept' , [HandleRequisitionStatus::class , 'ClientAcceptModification'])->name('requisition-client-accept');
        Route::delete('requisition-client-deny/{id}' , [HandleRequisitionStatus::class , 'ClientDenyModification'])->name('requisition-client-deny');
        Route::get('requisition-driver-show/{id}' , [HandleRequisitionStatus::class , 'DriverShowRequisition'])->name('requisition-driver-show');
        Route::get('requisition-driver-verify' , [HandleRequisitionStatus::class , 'DriverVerifyRequisition'])->name('requisition-driver-verify');
        Route::get('requisition-driver-deliver' , [HandleRequisitionStatus::class , 'DriverFinishRequisition'])->name('requisition-driver-deliver');
        Route::get('requisition-driver-start' , [HandleRequisitionStatus::class , 'DriverStartRequisition'])->name('requisition-driver-start');
        Route::post('requisition-client-first-signature' , [HandleRequisitionStatus::class , 'ClientFirstSignature'])->name('requisition-client-first-signature');
        Route::post('requisition-client-second-signature' , [HandleRequisitionStatus::class , 'ClientSecondSignature'])->name('requisition-client-second-signature');
        Route::post('requisition-driver-first-signature' , [HandleRequisitionStatus::class , 'DriverFirstSignature'])->name('requisition-driver-first-signature');
        Route::post('requisition-driver-second-signature' , [HandleRequisitionStatus::class , 'DriverSecondSignature'])->name('requisition-driver-second-signature');
        Route::get('requisition-print/{id}' , [HandleRequisitionStatus::class , 'RequisitionPrint'])->name('requisition-print');

        /*
        |--------------------------------------------------------------------------
        | End Handle Requisition Status Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start Requiusition Data Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('requisition-data' , RequisitionDataController::class);
        Route::get('requisition-data-datatable' , [RequisitionDataController::class , 'datatable'])->name('requisition-data.datatable');

        /*
        |--------------------------------------------------------------------------
        | End Requiusition Data Routes
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | Start Manage Client Payment Routes
        |--------------------------------------------------------------------------
        */

        Route::get('manage-client-payment' , [ManageClientPaymentController::class,'index'])->name('manage-client-payment.index');
        Route::get('show-client-payment' , [ManageClientPaymentController::class,'showClientPayment'])->name('show-client-payment');
        Route::get('print-client-payment' , [ManageClientPaymentController::class,'printClientPayment'])->name('print-client-payment');
        Route::get('pay-client-payment' , [ManageClientPaymentController::class,'ClientPay'])->name('pay-client-payment');
        Route::get('notify-client-payment' , [ManageClientPaymentController::class,'Notify'])->name('notify-client-payment');

        /*
        |--------------------------------------------------------------------------
        | End Manage Client Payment Routes
        |--------------------------------------------------------------------------
        */


        /*
        |--------------------------------------------------------------------------
        | Start System Setting Routes
        |--------------------------------------------------------------------------
        */

        Route::get('system-setting' , [SystemSettingController::class , 'index'])->name('system-setting.index');
        Route::post('system-setting' , [SystemSettingController::class , 'update'])->name('system-setting.update');

        /*
        |--------------------------------------------------------------------------
        | End System Setting Routes
        |--------------------------------------------------------------------------
        */




        /*
        |--------------------------------------------------------------------------
        | Start Driver Count Order Routes
        |--------------------------------------------------------------------------
        */

        Route::get('driver-count-order' , [DriverCountOrderController::class , 'index'])->name('driver-count-order.index');
        Route::get('driver-count-order-data' , [DriverCountOrderController::class , 'getDriverOrders'])->name('driver-count-order.data');
        Route::get('driver-count-order-print' , [DriverCountOrderController::class , 'print'])->name('driver-count-order.print');

        /*
        |--------------------------------------------------------------------------
        | End Driver Count Order Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Manage Income Routes
        |--------------------------------------------------------------------------
        */

        Route::get('manage-income' , [ManageIncomeController::class , 'index'])->name('manage-income.index');
        Route::get('show-income' , [ManageIncomeController::class , 'showIncome'])->name('show-income');
        Route::get('print-income' , [ManageIncomeController::class , 'printIncome'])->name('print-income');

        /*
        |--------------------------------------------------------------------------
        | End Manage Income Routes
        |--------------------------------------------------------------------------
        */



        /*
        |--------------------------------------------------------------------------
        | Start Client Payment Notification Routes
        |--------------------------------------------------------------------------
        */

        Route::get('client-payment-notification' , [ClientPaymentNotificationController::class , 'index'])->name('client-payment-notification.index');
        /*
        |--------------------------------------------------------------------------
        | End Client Payment Notification Routes
        |--------------------------------------------------------------------------
        */

    });

});






