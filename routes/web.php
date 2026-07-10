<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;

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




Route::middleware(['auth', 'role:Admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');


    Route::resource('/admin/managers', ManagerController::class)
        ->names('admin.managers');


    Route::resource('/admin/employees', EmployeeController::class)
    ->names('admin.employees');

    Route::get('/admin/employees/{id}/status/{status}',
[EmployeeController::class,'status'])
->name('admin.employees.status');

});
Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])
        ->name('manager.dashboard');
});

Route::middleware(['auth', 'role:Employee'])->group(function () {
    Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])
        ->name('employee.dashboard');
});


Route::middleware(['auth'])->group(function(){


    Route::post('/attendance/clock-in',
    [AttendanceController::class,'clockIn'])
    ->name('attendance.clockin');



    Route::post('/attendance/clock-out',
    [AttendanceController::class,'clockOut'])
    ->name('attendance.clockout');


});

require __DIR__.'/auth.php';
