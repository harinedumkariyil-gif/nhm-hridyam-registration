<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DeicController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [RegistrationController::class, 'index'])->name('register.index');
Route::post('/register/step1', [RegistrationController::class, 'postStep1'])->name('register.step1');
Route::post('/register/verify-otp', [RegistrationController::class, 'verifyOtp'])->name('register.verifyOtp');
Route::get('/register/step/{step}', [RegistrationController::class, 'showStep'])->name('register.showStep');
Route::post('/register/step/{step}', [RegistrationController::class, 'postStep'])->name('register.postStep');
Route::post('/register/diagnosis/add', [RegistrationController::class, 'addDiagnosis'])->name('register.addDiagnosis');
Route::delete('/register/diagnosis/{id}', [RegistrationController::class, 'deleteDiagnosis'])->name('register.deleteDiagnosis');
Route::get('/register/resume', [RegistrationController::class, 'resumeForm'])->name('register.resumeForm');
Route::post('/register/resume', [RegistrationController::class, 'resumePost'])->name('register.resumePost');
Route::get('/register/resume/{token}', [RegistrationController::class, 'resume'])->name('register.resume');

// DEIC Routes
Route::get('/deic/login', [DeicController::class, 'loginForm'])->name('deic.login');
Route::post('/deic/login', [DeicController::class, 'login']);
Route::middleware(['auth'])->group(function () {
    Route::get('/deic/dashboard', [DeicController::class, 'dashboard'])->name('deic.dashboard');
    Route::get('/deic/profile/{id}', [DeicController::class, 'showProfile'])->name('deic.profile');
    Route::post('/deic/verify/{id}', [DeicController::class, 'verify'])->name('deic.verify');
    Route::post('/deic/logout', [DeicController::class, 'logout'])->name('deic.logout');
});

// Pediatrician Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/pediatrician/dashboard', [\App\Http\Controllers\PediatricianController::class, 'dashboard'])->name('pediatrician.dashboard');
    Route::get('/pediatrician/case/{id}', [\App\Http\Controllers\PediatricianController::class, 'showCase'])->name('pediatrician.case');
    Route::post('/pediatrician/case/{id}/opinion', [\App\Http\Controllers\PediatricianController::class, 'markOpinion'])->name('pediatrician.markOpinion');
});
