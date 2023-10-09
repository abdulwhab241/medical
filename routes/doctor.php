<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\PatientController;
use App\Http\Controllers\Doctor\DiagnosticController;
use App\Http\Controllers\Doctor\PatientMedicineController;




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



//################################ dashboard Doctor ##########################################
    Route::get('/doctor/dashboard', function () {
        return view('Dashboard.Dashboard_Doctors.dashboard');
    })->middleware(['auth'])->name('dashboard.doctor');
//################################ end dashboard Doctor #####################################

Route::middleware(['auth'])->group(function () {


    //############################# Patient for Doctors route ###################################

        Route::get('/patient_cashes', [PatientController::class, 'patient_cash'])->name('patient_cash');
        Route::get('/patient_insurances', [PatientController::class, 'patient_insurance'])->name('patient_insurance');
        Route::get('/patient_Medicines/{id}', [PatientController::class, 'edit'])->name('add_medicines');
    
    //############################# end Patient for Doctors route ###############################

    //############################# Diagnostic Patients route ###################################

        Route::resource('Diagnostics', DiagnosticController::class);

    //############################# end Diagnostic Patients route ###############################

    //############################# Patient Medicines route ###################################

        Route::resource('Patient_Medicines', PatientMedicineController::class);

    //############################# end Patient Medicines route ###############################


});


require __DIR__.'/auth.php';