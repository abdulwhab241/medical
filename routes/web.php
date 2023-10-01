<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;

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

//################################ dashboard User ##########################################
    Route::get('/admin/dashboard', function () {
        return view('Dashboard.Admin.dashboard');
    })->middleware(['auth'])->name('dashboard.admin');
//################################ end dashboard User #####################################


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


    });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
