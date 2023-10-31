<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');

Route::get('employee/dashboard', function () {
    return view('employee.dashboard');
})->name('employee.dashboard');

Route::middleware('auth')->group(function () {
    //in
    Route::get('/show/in/{id}', [AttendanceController::class, 'showLoginPage'])->name('attendance.in');
    Route::post('/in', [AttendanceController::class, 'submitLogin'])->name('attendance.in');
    //out
    Route::get('/show/out/{id}', [AttendanceController::class, 'showLogoutPage'])->name('attendance.out');
    Route::post('/out', [AttendanceController::class, 'submitLogout'])->name('attendance.out');
    //leave
    Route::get('/show/leave/{id}', [AttendanceController::class, 'showLeavePage'])->name('attendance.leave');
    Route::post('/leave', [AttendanceController::class, 'submitLeave'])->name('attendance.leave');
    //individual employee
    Route::get('/attendance/{employeeId}',[AttendanceController::class,'individualAttendance'])->name('attendance.individual');
    //admin
    Route::get('/today-attendances', [AttendanceController::class, 'attendancesToday'])->middleware(['auth', 'role:admin'])->name('admin-dashboard.today-attendances');
    Route::get('/daily-attendances-report', [AttendanceController::class, 'dailyAttendanceReport'])->middleware(['auth', 'role:admin'])->name('admin-dashboard.daily-attendances');
});

//employee
// Route::middleware('auth')->group(function () {
//     Route::get('/daily-attendances', [AttendanceController::class, 'attendancesToday'])->name('dashboard.daily-attendances');
// });
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
