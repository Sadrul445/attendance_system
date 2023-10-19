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
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/attendances', [AttendanceController::class, 'attendancesToday'])->name('attendance.attendances');
Route::middleware('auth')->group(function () {
    Route::get('/in', [AttendanceController::class, 'showLoginPage'])->name('attendance.in');
    Route::post('/in', [AttendanceController::class, 'submitLogin']);
    Route::get('/out', [AttendanceController::class, 'showLogoutPage'])->name('attendance.out');
    Route::post('/out', [AttendanceController::class, 'submitLogout']);
    Route::get('/leave', [AttendanceController::class, 'showLeavePage'])->name('attendance.out');
    Route::post('/leave', [AttendanceController::class, 'submitLeave'])->name('attendance.leave');;
    Route::get('/daily-attendances', [AttendanceController::class, 'attendancesToday'])->name('dashboard.daily-attendances');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
