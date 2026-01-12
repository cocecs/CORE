<?php

use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\UserAboutController;
use App\Http\Controllers\UserSexController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EducationalController;
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
    //user about me route
    Route::get('/user/about', [UserAboutController::class, 'index'])->name('about.index');
    //store user about route
    Route::put('/user/{idno}/about', [UserDetailsController::class, 'updateAbout'])->name('about.update');
    //educational background route
    Route::get('/user/education', [EducationalController::class, 'index'])->name('background.index');
    //store educational background route
    Route::post('/user/education', [EducationalController::class, 'store'])->name('background.store');

    //profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
