<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ====================== Admin ======================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ManagerController;

// ====================== Manager ======================
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\LeaveController as ManagerLeaveController;

// ====================== Employee ======================
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\LeaveController;

// =====================================================

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ====================== Profile ======================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ====================== Admin Routes ======================

Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('managers', ManagerController::class);

        Route::resource('employees', EmployeeController::class);

        Route::get('employees/{id}/status/{status}',
            [EmployeeController::class, 'status'])
            ->name('employees.status');


       Route::resource('leaves', \App\Http\Controllers\Admin\LeaveController::class)
    ->parameters([
        'leaves' => 'leave'
    ]);

Route::patch(
    'leaves/{leave}/approve',
    [\App\Http\Controllers\Admin\LeaveController::class, 'approve']
)->name('leaves.approve');

Route::patch(
    'leaves/{leave}/reject',
    [\App\Http\Controllers\Admin\LeaveController::class, 'reject']
)->name('leaves.reject');

    });


// ====================== Manager Routes ======================

Route::middleware(['auth', 'role:Manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {

        Route::get('/dashboard', [ManagerDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('leaves', ManagerLeaveController::class)
            ->only(['index', 'show'])
            ->parameters([
                'leaves' => 'leave'
            ]);

        Route::patch(
            'leaves/{leave}/approve',
            [ManagerLeaveController::class, 'approve']
        )->name('leaves.approve');

        Route::patch(
            'leaves/{leave}/reject',
            [ManagerLeaveController::class, 'reject']
        )->name('leaves.reject');

    });


// ====================== Employee Routes ======================

Route::middleware(['auth', 'role:Employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {

        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
            ->name('dashboard');

        // Leave Management

        Route::resource('leaves', LeaveController::class)
    ->parameters([
        'leaves' => 'leave'
    ]);

    });


// ====================== Attendance ======================

Route::middleware('auth')->group(function () {

    Route::post('/attendance/clock-in',
        [AttendanceController::class, 'clockIn'])
        ->name('attendance.clockin');

    Route::post('/attendance/clock-out',
        [AttendanceController::class, 'clockOut'])
        ->name('attendance.clockout');

});

require __DIR__.'/auth.php';
