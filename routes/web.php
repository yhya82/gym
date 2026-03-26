<?php
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource(('plans'), PlanController::class);
    Route::resource(('users'), UserController::class);
    Route::resource(('members'),MemberController::class);
    Route::get('/members/{member}/renew',[MemberController::class, 'renew']); // for the renew form

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
