<?php

use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\UserAboutController;
use App\Http\Controllers\UserSexController;
use App\Http\Controllers\UserGenderController;
use App\Http\Controllers\UserCivilController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkDetailsController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\JobHistoryController;
use App\Http\Controllers\OfwController;
use App\Http\Controllers\FourpsController;
use App\Http\Controllers\JobPreferenceController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\EducationalController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\EmploymentStatusController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\JobRecommendationController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;

//landing page
Route::get('/', function () {
    return view('welcome');
});

//welcome page after registeration
Route::get('welcome1', function () {
    return view('welcome1');
})->middleware(['auth', 'verified'])->name('welcome1');

//welcome page for employers after registeration
Route::get('welcome2', function () {
    return view('welcome2');
})->middleware(['auth', 'verified'])->name('welcome2');

//welcome page for admin and peso
Route::get('welcome3', function () {
    return view('welcome3');
})->middleware(['auth', 'verified'])->name('welcome3');

//dashboard page
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//other pages for authenticated users
Route::middleware('auth')->group(function () {
    //user details route
    Route::get('/app', [UserDetailsController::class, 'index'])->name('details.index');
    //store user details route
    Route::post('/app', [UserDetailsController::class, 'store'])->name('details.store');
    //user address route
    Route::get('/app/address', [UserAddressController::class, 'index'])->name('address.index');

    Route::get('/api/provinces', [LocationController::class, 'getProvinces']);
    Route::get('/api/towns', [LocationController::class, 'getTowns']);
    Route::get('/api/barangays', [LocationController::class, 'getBarangays']);

    //update user address route
    Route::put('/app/{idno}/details', [UserDetailsController::class, 'update'])->name('app.update');
    //user sex route
    Route::get('/app/sex', [UserSexController::class, 'index'])->name('sex.index');
    //store user sex route
    Route::put('/app/{idno}/sex', [UserDetailsController::class, 'updatesex'])->name('sex.update');
    //user gender route
    Route::get('/app/gender', [UserGenderController::class, 'index'])->name('gender.index');
    //store user gender route
    Route::put('/app/{idno}/gender', [UserDetailsController::class, 'updateGender'])->name('gender.update');
    //user civil route
    Route::get('/app/civil', [UserCivilController::class, 'index'])->name('civil.index');
    //store user civil route
    Route::put('/app/{idno}/civil', [UserDetailsController::class, 'updateCivil'])->name('civil.update');
    //educational background route
    Route::get('/education', [EducationalController::class, 'index'])->name('background.index');
    //store educational background route
    Route::put('/education/{idno}', [EducationalController::class, 'updateCourse'])->name('background.update');
    // triger expertise
    Route::get('/expertise', [ExpertiseController::class, 'processMatch'])->name('expertise.process');
    // show expertise
    Route::get('/expertise/{code}', [ExpertiseController::class, 'show'])->name('expertise.show');
    // store expertise
    Route::put('/expertise/{idno}/skills', [WorkDetailsController::class, 'store'])->name('skills.store');
    //professional or experience level route
    Route::get('/professional', [ProfessionalController::class, 'index'])->name('professional.index');
    //store professional or experience level route
    Route::put('/professional/{idno}', [WorkDetailsController::class, 'update'])->name('exp.store');
    //employment status route
    Route::get('/job', [EmploymentStatusController::class, 'index'])->name('status.index');
    //employed or unemployed route
    Route::put('/job/{idno}', [WorkDetailsController::class, 'employ_status'])->name('job.employment');
    //unemployed route
    Route::get('/employment', [JobHistoryController::class, 'index'])->name('employment.index');
    //unemployed route
    Route::put('/employment/{idno}', [WorkDetailsController::class, 'unemployment'])->name('unemployment');
    //ofw route
    Route::get('/employment/ofw', [OfwController::class, 'index'])->name('ofw.index');
    //ofw route
    Route::put('/employment/{idno}/ofw', [WorkDetailsController::class, 'ofw_update'])->name('ofw_update');
    //4Ps route
    Route::get('/employment/fourps', [FourpsController::class, 'index'])->name('fourps.index');
    //4Ps route
    Route::put('/employment/{idno}/fourps', [WorkDetailsController::class, 'fourps'])->name('fourps');
    //parttime fulltime route
    Route::get('/job/prefocc', [JobPreferenceController::class, 'index'])->name('prefocc.index');
    //parttime fulltime route
    Route::put('/job/{idno}/prefocc', [JobPreferenceController::class, 'prefocc'])->name('prefocc');
    //distance job route
    Route::get('/job/distance', [JobPreferenceController::class, 'distance'])->name('distance.index');
    //store distance job route
    Route::put('/job/{idno}/distance', [JobPreferenceController::class, 'work_location'])->name('work_location');
    //user details route
    Route::get('/app/profile', [UserDetailsController::class, 'profile'])->name('profile');

    //store employer route
    Route::post('/app/emp', [EmployerController::class, 'emp_store'])->name('emp.store');
    // employer about route
    Route::get('/app/empa', [EmployerController::class, 'emp_about'])->name('emp.about');
    // employer about update route
    Route::put('/app/empa/{idno}', [EmployerController::class, 'update_about'])->name('update.about');

    // employer dashboard
    Route::get('/par', [JobPostingController::class, 'index'])->name('par.index');
    // employer job post route
    Route::get('/par/post', [JobPostingController::class, 'emp_post'])->name('emp.post');
    // getting the skills based on the selected expertise route
    Route::get('/get-skills/{expertiseId}', [JobPostingController::class, 'getSkillsByExpertise']);
    // employer post preference route
    Route::post('/par/post/{idno}', [JobPostingController::class, 'job_post'])->name('job_post');
    // employer details postc route
    Route::get('/par/postc/{job_id}', [JobPostingController::class, 'emp_postc'])->name('emp_postc');
    // employer details postc route
    Route::put('/par/postc/{job_id}', [JobPostingController::class, 'job_postc'])->name('job_postc');
    // employer list of job post
    Route::get('/par/lj', [JobPostingController::class, 'list_jobPosted'])->name('list_jobPosted');
    // employer job details route
    Route::get('/par/jd/{job_id}', [JobPostingController::class, 'parJobDetails'])->name('parJobDetails');
    // employer list of applicants specific job route
    Route::get('/par/la/{job_id}', [JobPostingController::class, 'parListApp'])->name('parListApp');
    // employer show applicant profile route
    Route::get('/par/app/{idno}/{job_id}', [JobPostingController::class, 'parAppProfile'])->name('parAppProfile');
    // employer add applicant to interview list route
    Route::post('/par/{job_id}/interview/{idno}', [JobPostingController::class, 'addToInterviewList'])->name('addToInterviewList');
    // employer remove applicant from interview list route
    Route::delete('/par/{job_id}/interview/{idno}/remove', [JobPostingController::class, 'removeFromInterviewList'])->name('jobs.removeInterviewe');
    // employer hire applicant route
    Route::patch('/par/{job_id}/interview/{idno}/hire', [JobPostingController::class, 'hireApplicant'])->name('jobs.hireApplicant');

    //list of recommended jobs route
    Route::get('/rec', [JobRecommendationController::class, 'index'])->name('recommended');
    // job details route
    Route::get('/recd/{job_id}', [JobRecommendationController::class, 'details'])->name('job_details');
    // Route for handling job application / saving / apply
    Route::middleware(['auth'])->group(function () {
        Route::post('/recd/{job_id}/save', [JobRecommendationController::class, 'toggleSave'])->name('jobs_save');
        Route::delete('/recd/{job_id}/cancel-application', [JobRecommendationController::class, 'cancel'])->name('jobs_cancel');
        Route::post('/recp/{job_id}', [JobRecommendationController::class, 'profile_review'])->name('profile_review');
        Route::post('/recp/{job_id}/apply', [JobRecommendationController::class, 'apply'])->name('jobs_apply');

    });

    // Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        // admin dashboard
        Route::get('/adtv', [AdminAccountController::class, 'index'])->name('adtv.index');
        // admin list of users
        Route::get('/adtv/lu', [AdminAccountController::class, 'adtv_listUsers'])->name('adtv_listUsers');
        // admin add new user
        Route::get('/adtv/nu', [AdminAccountController::class, 'adtv_addUser'])->name('adtv_addUser');
        // admin add new user
        Route::post('/adtv/nu', [AdminAccountController::class, 'adtv_storeUser'])->name('adtv_storeUser');
        // view user details by admin
        Route::get('/admin/users', [AdminAccountController::class, 'adtv_listUsers'])->name('adtv_listUsers');
        Route::get('/admin/admins', [AdminAccountController::class, 'adtv_listAdmins'])->name('adtv_listAdmins');
        // admin add employer
        Route::get('/adtv/emp', [AdminAccountController::class, 'adtv_storeEmployer'])->name('adtv_storeEmployer');
        // admin list of posted jobs
        Route::get('/adtv/loj', [AdminAccountController::class, 'listJobs'])->name('listJobs');
        // admin job details route
        Route::get('/adtv/loj/{job_id}', [AdminAccountController::class, 'jobDetails'])->name('jobDetails');
        // admin job applicants route
        Route::get('/adtv/loa/{job_id}', [AdminAccountController::class, 'jobApplicants'])->name('jobApplicants');
        // admin show applicant profile route
        Route::get('/adtv/appl/{idno}/{job_id}', [AdminAccountController::class, 'applProfile'])->name('applProfile');

    // });

    //user about me route
    Route::get('/app/about', [UserAboutController::class, 'index'])->name('about.index');
    //store user about route
    Route::put('/app/{idno}/about', [UserDetailsController::class, 'updateAbout'])->name('about.update');

    //profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
