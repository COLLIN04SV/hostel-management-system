<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

Route::resource('students', StudentController::class);
Route::resource('hostels', HostelController::class);
Route::resource('rooms', RoomController::class);
Route::resource('allocations', AllocationController::class);
Route::resource('applications', ApplicationController::class);
Route::resource('payments', PaymentController::class);
Route::resource('notices', NoticeController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/dashboard', [
    DashboardController::class,
    'admin'
])->name('admin.dashboard');

Route::get('/students/{student}', [StudentController::class, 'show'])
    ->name('students.show');

Route::get('/students/{student}/edit', [StudentController::class, 'edit'])
    ->name('students.edit');

Route::put('/students/{student}', [StudentController::class, 'update'])
    ->name('students.update');

Route::delete('/students/{student}', [StudentController::class, 'destroy'])
    ->name('students.destroy');

Route::post(
    '/allocations/{allocation}/vacate',
    [AllocationController::class, 'vacate']
)->name('allocations.vacate');

Route::post(
    '/applications/{id}/approve',
    [ApplicationController::class, 'approve']
)->name('applications.approve');

Route::post(
    '/applications/{id}/reject',
    [ApplicationController::class, 'reject']
)->name('applications.reject');

Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');

Route::get('/payments/create', [PaymentController::class, 'create'])
    ->name('payments.create');

Route::post('/payments/store', [PaymentController::class, 'store'])
    ->name('payments.store');

Route::get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');

Route::get('/settings', [SettingController::class, 'index'])
    ->name('settings.index');

Route::post('/settings', [SettingController::class, 'update'])
    ->name('settings.update');   

Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('student.dashboard');

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