<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailSettingController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MailTestController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/email-settings', [EmailSettingController::class, 'index'])->name('email-settings.index');
// Route::post('/email-settings/update', [EmailSettingController::class, 'update'])->name('email-settings.update');


// Route::post('/send-mail', [MailController::class, 'sendEmail'])->name('send-mail');




// // Route::get('/email-settings', [EmailSettingController::class, 'index'])->name('email-settings.index');
// // Route::post('/email-settings/update', [EmailSettingController::class, 'update'])->name('email-settings.update');


// Route::get('/send-test-email', [MailTestController::class, 'sendTestEmail']);



Route::get('/email-settings', [EmailSettingController::class, 'index'])->name('email-settings.index');
Route::post('/email-settings/update', [EmailSettingController::class, 'update'])->name('email-settings.update');
Route::post('/email-settings/send-test-email', [EmailSettingController::class, 'sendTestEmail'])->name('email-settings.sendTestEmail');
Route::post('/send-test-email', [EmailSettingController::class, 'sendTestEmail'])->name('send-test-email');


