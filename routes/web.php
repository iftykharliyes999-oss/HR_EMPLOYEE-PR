<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\LoanController;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\Admin\ManagerController as AdminManagerController;
use App\Http\Controllers\Admin\HolidayController as AdminHolidayController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;

/*
|--------------------------------------------------------------------------
| Manager Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\LeaveController as ManagerLeaveController;
use App\Http\Controllers\Manager\HolidayController as ManagerHolidayController;
use App\Http\Controllers\Manager\ProfileController as ManagerProfileController;
use App\Http\Controllers\Manager\TaskController as ManagerTaskController;
use App\Http\Controllers\Manager\AttendanceController as ManagerAttendanceController;
use App\Http\Controllers\Manager\AttendanceApprovalController;

/*
|--------------------------------------------------------------------------
| Employee Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\AttendanceController as EmployeeAttendanceController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\Employee\HolidayController as EmployeeHolidayController;
use App\Http\Controllers\Employee\ProfileController as EmployeeProfileController;
use App\Http\Controllers\Employee\TaskController as EmployeeTaskController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Common Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [AdminDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Manager Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'managers',
            AdminManagerController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Employee Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'employees',
            AdminEmployeeController::class
        );

        Route::get(
            '/employees/{id}/status/{status}',
            [AdminEmployeeController::class, 'status']
        )->name('employees.status');


        /*
        |--------------------------------------------------------------------------
        | Attendance Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/attendance',
            [AdminAttendanceController::class, 'index']
        )->name('attendance.index');

        Route::get(
            '/attendance/employee/{employee}',
            [AdminAttendanceController::class, 'show']
        )->name('attendance.show');


        /*
        |--------------------------------------------------------------------------
        | Holiday Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'holidays',
            AdminHolidayController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Leave Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'leaves',
            AdminLeaveController::class
        )->parameters([
            'leaves' => 'leave',
        ]);

        Route::patch(
            '/leaves/{leave}/approve',
            [AdminLeaveController::class, 'approve']
        )->name('leaves.approve');

        Route::patch(
            '/leaves/{leave}/reject',
            [AdminLeaveController::class, 'reject']
        )->name('leaves.reject');


        /*
        |--------------------------------------------------------------------------
        | Notification Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'notifications',
            AdminNotificationController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Task Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'tasks',
            AdminTaskController::class
        );


        /*
        |--------------------------------------------------------------------------
        | Payroll Management
        |--------------------------------------------------------------------------
        */

        Route::prefix('payroll')
            ->name('payroll.')
            ->group(function () {

                Route::get(
                    '/',
                    [PayrollController::class, 'index']
                )->name('index');

                Route::post(
                    '/generate',
                    [PayrollController::class, 'generate']
                )->name('generate');

                /*
                | Draft payroll-এর salary components update
                */

                Route::patch(
                    '/{payroll}/components',
                    [PayrollController::class, 'updateComponents']
                )->name('components.update');

                /*
                | Salary payment
                */

                Route::patch(
                    '/{payroll}/pay',
                    [PayrollController::class, 'pay']
                )->name('pay');

                /*
                | Dynamic show route সবশেষে থাকবে
                */

                Route::get(
                    '/{payroll}',
                    [PayrollController::class, 'show']
                )->name('show');
            });


        /*
        |--------------------------------------------------------------------------
        | Loan Management
        |--------------------------------------------------------------------------
        */

        Route::prefix('loans')
            ->name('loans.')
            ->group(function () {

                Route::get(
                    '/',
                    [AdminLoanController::class, 'index']
                )->name('index');

                Route::patch(
                    '/{loan}/approve',
                    [AdminLoanController::class, 'approve']
                )->name('approve');

                Route::patch(
                    '/{loan}/reject',
                    [AdminLoanController::class, 'reject']
                )->name('reject');
            });
    });


/*
|--------------------------------------------------------------------------
| Manager Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [ManagerDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Attendance Overview
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/attendance',
            [ManagerAttendanceController::class, 'index']
        )->name('attendance.index');

        Route::get(
            '/attendance/employee/{employee}',
            [ManagerAttendanceController::class, 'show']
        )->name('attendance.show');


        /*
        |--------------------------------------------------------------------------
        | Attendance Approval
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/attendance/{attendance}/clock-in/approve',
            [AttendanceApprovalController::class, 'approveClockIn']
        )->name('attendance.clock-in.approve');

        Route::patch(
            '/attendance/{attendance}/clock-in/reject',
            [AttendanceApprovalController::class, 'rejectClockIn']
        )->name('attendance.clock-in.reject');

        Route::patch(
            '/attendance/{attendance}/clock-out/approve',
            [AttendanceApprovalController::class, 'approveClockOut']
        )->name('attendance.clock-out.approve');

        Route::patch(
            '/attendance/{attendance}/clock-out/reject',
            [AttendanceApprovalController::class, 'rejectClockOut']
        )->name('attendance.clock-out.reject');


        /*
        |--------------------------------------------------------------------------
        | Leave Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'leaves',
            ManagerLeaveController::class
        )
            ->only(['index', 'show'])
            ->parameters([
                'leaves' => 'leave',
            ]);

        Route::patch(
            '/leaves/{leave}/approve',
            [ManagerLeaveController::class, 'approve']
        )->name('leaves.approve');

        Route::patch(
            '/leaves/{leave}/reject',
            [ManagerLeaveController::class, 'reject']
        )->name('leaves.reject');


        /*
        |--------------------------------------------------------------------------
        | Holidays
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/holidays',
            [ManagerHolidayController::class, 'index']
        )->name('holidays.index');


        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile',
            [ManagerProfileController::class, 'index']
        )->name('profile');


        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/notifications/{notification}',
            [AdminNotificationController::class, 'show']
        )->name('notifications.show');


        /*
        |--------------------------------------------------------------------------
        | My Salary
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/salary',
            [SalaryController::class, 'index']
        )->name('salary.index');

        Route::patch(
            '/salary/{payroll}/received',
            [SalaryController::class, 'received']
        )->name('salary.received');


        /*
        |--------------------------------------------------------------------------
        | My Loan Requests
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/loans',
            [LoanController::class, 'index']
        )->name('loans.index');

        Route::post(
            '/loans',
            [LoanController::class, 'store']
        )->name('loans.store');


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
                    [ManagerTaskController::class, 'index']
                )->name('index');

                Route::get(
                    '/create',
                    [ManagerTaskController::class, 'create']
                )->name('create');

                Route::post(
                    '/',
                    [ManagerTaskController::class, 'store']
                )->name('store');

                /*
                | Specific route dynamic task route-এর আগে থাকবে
                */

                Route::get(
                    '/employee/{employee}',
                    [ManagerTaskController::class, 'employeeReport']
                )->name('employee.report');

                Route::get(
                    '/{task}',
                    [ManagerTaskController::class, 'show']
                )->name('show');
            });
    });


/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:Employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [EmployeeDashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Attendance Clock In / Clock Out
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/attendance/clock-in',
            [EmployeeAttendanceController::class, 'clockIn']
        )->name('attendance.clockin');

        Route::post(
            '/attendance/clock-out',
            [EmployeeAttendanceController::class, 'clockOut']
        )->name('attendance.clockout');


        /*
        |--------------------------------------------------------------------------
        | Attendance Calendar
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/attendance-calendar',
            [EmployeeDashboardController::class, 'calendar']
        )->name('calendar');

        Route::get(
            '/attendance-events',
            [EmployeeDashboardController::class, 'calendarEvents']
        )->name('calendar.events');


        /*
        |--------------------------------------------------------------------------
        | Leave Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'leaves',
            EmployeeLeaveController::class
        )->parameters([
            'leaves' => 'leave',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Holidays
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/holidays',
            [EmployeeHolidayController::class, 'index']
        )->name('holidays.index');


        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/profile',
            [EmployeeProfileController::class, 'index']
        )->name('profile');


        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/notifications/{notification}',
            [AdminNotificationController::class, 'show']
        )->name('notifications.show');


        /*
        |--------------------------------------------------------------------------
        | My Salary
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/salary',
            [SalaryController::class, 'index']
        )->name('salary.index');

        Route::patch(
            '/salary/{payroll}/received',
            [SalaryController::class, 'received']
        )->name('salary.received');


        /*
        |--------------------------------------------------------------------------
        | My Loan Requests
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/loans',
            [LoanController::class, 'index']
        )->name('loans.index');

        Route::post(
            '/loans',
            [LoanController::class, 'store']
        )->name('loans.store');


        /*
        |--------------------------------------------------------------------------
        | Tasks
        |--------------------------------------------------------------------------
        */

        Route::prefix('tasks')
            ->name('tasks.')
            ->group(function () {

                Route::get(
                    '/',
                    [EmployeeTaskController::class, 'index']
                )->name('index');

                Route::post(
                    '/{task}/submit',
                    [EmployeeTaskController::class, 'submit']
                )->name('submit');

                Route::get(
                    '/{task}',
                    [EmployeeTaskController::class, 'show']
                )->name('show');
            });
    });


require __DIR__ . '/auth.php';
