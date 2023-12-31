<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\RayServiceController;
use App\Http\Controllers\Admin\RayEmployeeController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\SurgeryServiceController;
use App\Http\Controllers\Admin\InsuranceDetailController;
use App\Http\Controllers\Admin\InsuranceInvoiceController;
use App\Http\Controllers\Admin\PharmacyEmployeeController;
use App\Http\Controllers\Admin\LaboratoryServiceController;
use App\Http\Controllers\Admin\LaboratoryEmployeeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/login', [HomeController::class, 'index'])->name('selection');

//################################ dashboard Admin ##########################################
    Route::get('/admin/dashboard', function () {
        return view('Dashboard.Admin.dashboard');
    })->middleware(['auth'])->name('dashboard.admin');
//################################ end dashboard Admin #####################################


// //################################ dashboard admin ########################################
//     Route::get('/dashboard/admin', function () {
//         return view('Dashboard.Admin.dashboard');
//     })->middleware(['auth:admin'])->name('dashboard.admin');

// //################################ end dashboard admin #####################################

    Route::middleware(['auth'])->group(function () {

        //############################# sections route ##########################################

            Route::resource('Sections', SectionController::class);

        //############################# end sections route ######################################

        //############################# Doctors route ##########################################

            Route::resource('Doctors', DoctorController::class);
            Route::post('update_password', [DoctorController::class, 'update_password'])->name('update_password');
            Route::post('update_status', [DoctorController::class, 'update_status'])->name('update_status');

        //############################# end Doctors route ######################################

        //############################# Patients route ##########################################

            Route::resource('Patients', PatientController::class); 

        //############################# end Patients route ######################################

        //############################# Services route ##########################################

            Route::resource('Service', ServiceController::class);

        //############################# end Services route ######################################

        //############################# Ray Services route ##########################################

            Route::resource('Ray_Services', RayServiceController::class);

        //############################# end Ray Services route ######################################

        //############################# Laboratory Services route ##########################################

            Route::resource('Laboratory_Services', LaboratoryServiceController::class);

        //############################# end Laboratory Services route ######################################

        //############################# Surgery Services route ##########################################

            Route::resource('Surgery_Services', SurgeryServiceController::class);

        //############################# end Surgery Services route ######################################
                
        //############################# Insurances route ########################################

            Route::resource('insurance', InsuranceController::class);

        //############################# end Insurances route ###################################

        //############################# InsuranceDetails route #################################

            Route::resource('InsuranceDetails', InsuranceDetailController::class);

        //############################# end InsuranceDetails route #############################

        //############################# Cash_Invoices route ####################################

            Route::resource('CashInvoices', InvoiceController::class);
            Route::get('/Get_prices/{id}', [HomeController::class,'Get_Prices']);

        //############################# end Cash_Invoices route ################################

        //############################# Insurance_Invoice route ##########################################

            Route::resource('InsuranceInvoice', InsuranceInvoiceController::class);

        //############################# end Insurance_Invoice route ######################################

        //############################# Receipt route ##########################################

            Route::resource('Receipt', ReceiptController::class);

        //############################# end Receipt route ######################################

        //############################# Payment route ##########################################

            Route::resource('Payment', PaymentController::class);

        //############################# end Payment route ######################################

        //############################# Salary route ##########################################

            Route::resource('Salary', SalaryController::class);
            Route::get('/Print_Salaries', [SalaryController::class, 'print'])->name('Print_Salary');

        //############################# end Salary route ######################################

        //############################# Expense route ##########################################

            Route::resource('Expense', ExpenseController::class);
            Route::get('/Print_Expenses', [ExpenseController::class, 'print'])->name('Print_Expense');

      //############################# end Expense route ######################################

    //############################# Ray_Employee route ##########################################

        Route::resource('Ray_Employee', RayEmployeeController::class);

    //############################# end Ray_Employee route ######################################

    //############################# Laboratory_Employee route ##########################################

        Route::resource('Laboratory_Employee', LaboratoryEmployeeController::class);

    //############################# end Laboratory_Employee route ######################################
    
    //############################# Pharmacy_Employee route ##########################################

        Route::resource('Pharmacy_Employee', PharmacyEmployeeController::class);

    //############################# end Pharmacy_Employee route ######################################

    //############################# Medicine route ##########################################

        Route::resource('Medicine', MedicineController::class);
        Route::get('/Print_Medicines', [MedicineController::class, 'print'])->name('Print_Medicine');

    //############################# end Medicine route ######################################

    //############################# Profile route ##########################################

        Route::resource('Admin_Profile', AdminProfileController::class);

    //############################# end Profile route ######################################


    });




require __DIR__.'/auth.php';
