<?php

use Illuminate\Support\Facades\Route;




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






require __DIR__.'/auth.php';