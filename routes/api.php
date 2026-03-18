<?php
use App\Http\Controllers\Api\MemberApiController;
use App\Http\Controllers\Api\DashboardApiController;

use Illuminate\Support\Facades\Route;


Route::apiResource('members',MemberApiController::class);
Route::get('dashboard',[DashboardApiController::class, 'index']);