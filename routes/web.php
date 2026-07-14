<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ====================== Admin ======================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\NotificationController;
// ====================== Manager ======================
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\LeaveController as ManagerLeaveController;

use App\Http\Controllers\Manager\HolidayController as ManagerHolidayController;

// ====================== Employee ======================
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\LeaveController;
use App\Http\Controllers\Employee\HolidayController as EmployeeHolidayController;

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

        Route::get(
            'employees/{id}/status/{status}',
            [EmployeeController::class, 'status']
        )->name('employees.status');

        Route::resource(
            'holidays',
            \App\Http\Controllers\Admin\HolidayController::class
        );


        Route::resource(
            'holidays',
            \App\Http\Controllers\Admin\HolidayController::class
        );


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

        Route::resource('notifications', NotificationController::class);

        Route::resource('tasks', \App\Http\Controllers\Admin\TaskController::class);

    });




/// ====================== Manager Routes ======================

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

        Route::get(
            'holidays',
            [ManagerHolidayController::class, 'index']
        )->name('holidays.index');

        Route::get(
            'profile',
            [\App\Http\Controllers\Manager\ProfileController::class, 'index']
        )->name('profile');

        // Notification
        Route::get(
            '/notifications/{notification}',
            [\App\Http\Controllers\Admin\NotificationController::class, 'show']
        )->name('notifications.show');

        /*
        |--------------------------------------------------------------------------
        | Task Management
        |--------------------------------------------------------------------------
        */

        Route::prefix('tasks')
            ->name('tasks.')
            ->group(function () {

                Route::get(
                    '/',
                    [\App\Http\Controllers\Manager\TaskController::class, 'index']
                )->name('index');

                Route::get(
                    '/create',
                    [\App\Http\Controllers\Manager\TaskController::class, 'create']
                )->name('create');

                Route::post(
                    '/',
                    [\App\Http\Controllers\Manager\TaskController::class, 'store']
                )->name('store');

                Route::get(
                    '/{task}',
                    [\App\Http\Controllers\Manager\TaskController::class, 'show']
                )->name('show');

                Route::get(
                    '/employee/{employee}',
                    [\App\Http\Controllers\Manager\TaskController::class, 'employeeReport']
                )->name('employee.report');

            });

    });

// ====================== Employee Routes ======================

Route::middleware(['auth', 'role:Employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {

        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('leaves', LeaveController::class)
            ->parameters([
                'leaves' => 'leave'
            ]);

        Route::get(
            'holidays',
            [EmployeeHolidayController::class, 'index']
        )->name('holidays.index');

        Route::get(
            'profile',
            [\App\Http\Controllers\Employee\ProfileController::class, 'index']
        )->name('profile');


        Route::get(
            'attendance-calendar',
            [EmployeeDashboardController::class, 'calendar']
        )->name('calendar');

        Route::get(
            'attendance-events',
            [EmployeeDashboardController::class, 'calendarEvents']
        )->name('calendar.events');

       Route::get(
    '/notifications/{notification}',
    [\App\Http\Controllers\Admin\NotificationController::class, 'show']
)->name('notifications.show');




        Route::prefix('tasks')
    ->name('tasks.')
    ->group(function () {

        Route::get('/', [\App\Http\Controllers\Employee\TaskController::class, 'index'])
            ->name('index');

        Route::get('/{task}', [\App\Http\Controllers\Employee\TaskController::class, 'show'])
            ->name('show');

        Route::post('/{task}/submit', [\App\Http\Controllers\Employee\TaskController::class, 'submit'])
            ->name('submit');
    });
    });


// ====================== Attendance ======================

Route::middleware('auth')->group(function () {

    Route::post(
        '/attendance/clock-in',
        [AttendanceController::class, 'clockIn']
    )
        ->name('attendance.clockin');

    Route::post(
        '/attendance/clock-out',
        [AttendanceController::class, 'clockOut']
    )
        ->name('attendance.clockout');

});

require __DIR__ . '/auth.php';
