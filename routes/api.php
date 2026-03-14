<?php
use App\Http\Controllers\Api\MemberApiController;
use Illuminate\Support\Facades\Route;


Route::apiResource('members',MemberApiController::class);