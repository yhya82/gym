<?php
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // named the routes caused it get gets mixed up with the api controller 
    Route::resource(('members'),MemberController::class)->names([
    'index' => 'members.web.index',
    'create' => 'members.web.create',
    'store' => 'members.web.store',
    'show' => 'members.web.show',
    'edit' => 'members.web.edit',
    'update' => 'members.web.update',
    'destroy' => 'members.web.destroy',
]);
    Route::get('/members/{member}/renew',[MemberController::class, 'renew']); // for the renew form
   
    
});

Route::middleware('auth', 'role:owner')->group( function () {
Route::resource(('plans'), PlanController::class);
 Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
 Route::get('/audit',[AuditLogController::class, 'index'])->name('audit');
    Route::resource(('users'), UserController::class);
    
   
    
});

require __DIR__.'/auth.php';
