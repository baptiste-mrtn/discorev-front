<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\JobOfferController;

Route::permanentRedirect('/', '/home');

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth
Route::get('/auth/{tab?}', [AuthController::class, 'show'])->name('auth');
Route::get('/login', function () {
    return redirect()->route('auth', ['tab' => 'login']);
})->name('login');
Route::get('/register', function () {
    return redirect()->route('auth', ['tab' => 'register']);
})->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Routes with auth needed
Route::middleware(['auth'])->group(function () {

    //Profile
    Route::get('/complete-profile', [ProfileController::class, 'showCompletionForm'])->name('complete-profile');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Paramètres
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // Candidatures
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

    // Pour le candidat
    Route::get('/my-applications', [ApplicationController::class, 'indexForCandidate'])->name('applications.candidate');

    // Pour le recruteur
    Route::get('/recruiter/applications', [ApplicationController::class, 'indexForRecruiter'])->name('applications.recruiter');
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
});

// Accès public
Route::get('/job_offers', [JobOfferController::class, 'index'])->name('job_offers.index');

// Pour recruteurs
Route::middleware(['auth', 'recruiter'])->group(function () {
    Route::get('/recruiter/my-job_offers', [JobOfferController::class, 'myOffers'])->name('recruiter.jobs.index');
    Route::get('/job_offers/create', [JobOfferController::class, 'create'])->name('recruiter.jobs.create');
    Route::post('/job_offers', [JobOfferController::class, 'store'])->name('recruiter.jobs.store');
    Route::get('/job_offers/{id}/edit', [JobOfferController::class, 'edit'])->name('job_offers.edit');
    Route::put('/job_offers/{id}', [JobOfferController::class, 'update'])->name('job_offers.update');
    Route::delete('/job_offers/{id}', [JobOfferController::class, 'destroy'])->name('job_offers.destroy');
    Route::get('/cvtheque', [CandidateController::class, 'index'])->name('cvtheque.index');
});

Route::get('/job_offers/{id}', [JobOfferController::class, 'show'])->name('job_offers.show');
