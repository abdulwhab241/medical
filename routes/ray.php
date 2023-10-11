<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ray\PatientController;
use App\Http\Controllers\Ray\DiagnosticController;
use App\Http\Controllers\Ray\PatientRayController;
use App\Http\Controllers\Ray\PatientMedicineController;




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



//################################ dashboard Ray ##########################################
    Route::get('/ray/dashboard', function () {
        return view('Dashboard.Dashboard_Rays.dashboard');
    })->middleware(['auth'])->name('dashboard.Ray');
//################################ end dashboard Ray #####################################

Route::middleware(['auth'])->group(function () {


    //############################# Patient for Rays route ###################################

        Route::get('/patient_cashes', [PatientController::class, 'patient_cash'])->name('patient_cash');
        Route::get('/patient_insurances', [PatientController::class, 'patient_insurance'])->name('patient_insurance');
        Route::get('/patient_Medicines/{id}', [PatientController::class, 'edit'])->name('add_medicines');
        Route::get('/all_patients', [PatientController::class, 'all'])->name('all_patients');
        Route::get('/details_patient/{id}', [PatientController::class, 'show_patient'])->name('details_patient');
        Route::get('/patient_Xray/{id}', [PatientController::class, 'edit_xray'])->name('add_Xray');
    
    //############################# end Patient for Rays route ###############################

    //############################# Diagnostic Patients route ###################################

        Route::resource('Diagnostics', DiagnosticController::class);

    //############################# end Diagnostic Patients route ###############################

    //############################# Patient Medicines route ###################################

        Route::resource('Patient_Medicines', PatientMedicineController::class);

    //############################# end Patient Medicines route ###############################

    //############################# Patient Rays route ###################################

        Route::resource('Patient_Rays', PatientRayController::class);

    //############################# end Patient Rays route ###############################

});


require __DIR__.'/auth.php';