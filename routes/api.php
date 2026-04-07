<?php
use App\Http\Controllers\Api\MemberApiController;
use App\Http\Controllers\Api\DashboardApiController;

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (){ 


Route::get('/dashboard',[DashboardApiController::class, 'index']);
Route::apiResource('/members',MemberApiController::class);

});
