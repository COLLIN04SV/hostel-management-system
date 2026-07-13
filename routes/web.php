<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\SupportController;
use App\Http\Controllers\Student\SettingController as StudentSettingController;
use App\Http\Controllers\Student\PaymentController as StudentPaymentController;
use App\Http\Controllers\Student\ReceiptController as StudentReceiptController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Default Laravel Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| User Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| ADMIN MODULE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [
        DashboardController::class,
        'admin'
    ])->name('admin.dashboard');

    Route::resource('students', StudentController::class);

    Route::resource('hostels', HostelController::class);

    Route::resource('rooms', RoomController::class);

    Route::resource('applications', ApplicationController::class);

    Route::resource('allocations', AllocationController::class);

    Route::resource('payments', PaymentController::class);

    Route::resource('notices', NoticeController::class);

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    Route::post('/settings', [SettingController::class, 'update'])
        ->name('settings.update');

    Route::post(
        '/applications/{id}/approve',
        [ApplicationController::class, 'approve']
    )->name('applications.approve');

    Route::post(
        '/applications/{id}/reject',
        [ApplicationController::class, 'reject']
    )->name('applications.reject');

    Route::get(
    '/applications/student/{student}/hostels',
    [ApplicationController::class, 'getHostels']
    )->name('applications.hostels');

    Route::get(
    '/allocations/student/{student}/rooms',
    [AllocationController::class, 'getRooms']
   )->name('allocations.rooms');

    Route::post(
        '/allocations/{allocation}/vacate',
        [AllocationController::class, 'vacate']
    )->name('allocations.vacate');

});

/*
|--------------------------------------------------------------------------
| STUDENT PORTAL
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/student/dashboard',
        [StudentDashboardController::class, 'index']
    )->name('student.dashboard');

    Route::get(
        '/student/apply-hostel',
        [ApplicationController::class, 'studentCreate']
    )->name('student.application.create');

    Route::post(
        '/student/apply-hostel',
        [ApplicationController::class, 'studentStore']
    )->name('student.application.store');

    Route::get(
        '/student/my-applications',
        [ApplicationController::class, 'studentIndex']
    )->name('student.applications.index');

    Route::get(
        '/student/my-profile',
        [StudentProfileController::class, 'index']
    )->name('student.profile');

    Route::get(
        '/student/my-room',
    [StudentDashboardController::class, 'room']
    )->name('student.room');

    Route::get(
    '/student/payments',
    [\App\Http\Controllers\Student\PaymentController::class,'index']
    )->name('student.payments');

    Route::get(
    '/student/receipts',
    [StudentDashboardController::class, 'receipts']
    )->name('student.receipts');

    Route::get(
    '/student/notices',
    [StudentDashboardController::class, 'notices']
    )->name('student.notices');

    Route::get(
    '/student/support',
    [SupportController::class, 'index']
    )->name('student.support');

    Route::post(
    '/student/support',
    [SupportController::class, 'store']
    )->name('student.support.store');

    Route::get(
    '/student/support/create',
    [SupportController::class, 'create']
    )->name('student.support.create');

    Route::get(
    '/student/settings',
    [StudentSettingController::class, 'index']
    )->name('student.settings');

    Route::post(
    '/student/settings',
    [StudentSettingController::class, 'update']
    )->name('student.settings.update');

    Route::get(
    '/student/notices',
    [NoticeController::class, 'studentIndex']
    )->name('student.notices');

    Route::get(
    '/student/notices/{notice}',
    [NoticeController::class, 'studentShow']
    )->name('student.notices.show');

    Route::get(
    '/student/payments/{payment}/receipt',
    [StudentPaymentController::class, 'receipt']
    )->name('student.payments.receipt');

    Route::get(
    '/student/receipts',
    [StudentReceiptController::class, 'index']
    )->name('student.receipts.index');
  
    Route::get(
    '/student/receipts/{payment}/download',
    [StudentReceiptController::class, 'download']
    )->name('student.receipts.download');

    Route::post(
    '/student/profile/photo',
    [StudentProfileController::class, 'updatePhoto']
    )->name('student.profile.photo');
});