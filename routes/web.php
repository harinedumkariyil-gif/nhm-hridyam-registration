<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

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
