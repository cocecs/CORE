<?php

use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\UserAboutController;
use App\Http\Controllers\UserSexController;
use App\Http\Controllers\UserCivilController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkDetailsController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\JobHistoryController;
use App\Http\Controllers\ExploringJobController;
use App\Http\Controllers\DistanceJobController;
use App\Http\Controllers\JobRolesController;
use App\Http\Controllers\JobShiftController;
use App\Http\Controllers\ExpertiseController;
use Illuminate\Support\Facades\Route;

//landing page
Route::get('/', function () {
    return view('welcome');
});

//welcome page after registeration
Route::get('welcome1', function () {
    return view('welcome1');
})->middleware(['auth', 'verified'])->name('welcome1');

//dashboard page
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//other pages for authenticated users
Route::middleware('auth')->group(function () {
    //user details route
    Route::get('/user', [UserDetailsController::class, 'index'])->name('details.index');
    //store user details route
    Route::post('/user', [UserDetailsController::class, 'store'])->name('details.store');
    //user address route
    Route::get('/user/address', [UserAddressController::class, 'index'])->name('address.index');
    //update user address route
    Route::put('/user/{idno}/details', [UserDetailsController::class, 'update'])->name('user.update');
    //user sex route
    Route::get('/user/sex', [UserSexController::class, 'index'])->name('sex.index');
    //store user sex route
    Route::put('/user/{idno}/sex', [UserDetailsController::class, 'updates'])->name('sex.update');
    //user civil route
    Route::get('/user/civil', [UserCivilController::class, 'index'])->name('civil.index');
    //store user civil route
    Route::put('/user/{idno}/civil', [UserDetailsController::class, 'updateCivil'])->name('civil.update');
    //user about me route
    Route::get('/user/about', [UserAboutController::class, 'index'])->name('about.index');
    //store user about route
    Route::put('/user/{idno}/about', [UserDetailsController::class, 'updateAbout'])->name('about.update');
    //educational background route
    Route::get('/education', [WorkDetailsController::class, 'index'])->name('background.index');
    //store educational background route
    Route::post('/education', [WorkDetailsController::class, 'store'])->name('background.store');
    //professional or experience level route
    Route::get('/professional', [ProfessionalController::class, 'index'])->name('exp.index');
    //store professional or experience level route
    Route::put('/professional/{idno}', [WorkDetailsController::class, 'update'])->name('exp.store');
    //job history route
    Route::get('/job', [JobHistoryController::class, 'index'])->name('job.index');
    //store job history route
    Route::put('/job/{idno}', [WorkDetailsController::class, 'updates'])->name('job.store');
    //exploring job route
    Route::get('/job/expjob', [ExploringJobController::class, 'index'])->name('expjob.index');
    //store exploring job route
    Route::put('/job/{idno}/expjob', [WorkDetailsController::class, 'exp_job'])->name('expjob.store');
    //distance job route
    Route::get('/job/distance', [DistanceJobController::class, 'index'])->name('distance.index');
    //store distance job route
    Route::put('/job/{idno}/distance', [WorkDetailsController::class, 'distance_job'])->name('distance.store');
    //distance job route
    Route::get('/job/roles', [JobRolesController::class, 'index'])->name('roles.index');
    //store distance job route
    Route::put('/job/{idno}/roles', [WorkDetailsController::class, 'job_roles'])->name('roles.store');
    //job Shift route
    Route::get('/job/shift', [JobShiftController::class, 'index'])->name('shift.index');
    //store distance job route
    Route::put('/job/{idno}/shift', [WorkDetailsController::class, 'job_shift'])->name('shift.store');
    //expertise route
    Route::get('/expertise', [ExpertiseController::class, 'index'])->name('expertise.index');
    //store expertise route
    Route::put('/expertise/{idno}', [WorkDetailsController::class, 'expertise'])->name('expertise.store');

    //profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
