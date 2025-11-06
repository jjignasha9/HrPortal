<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\LeaveRequest;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/leaves', function(){
    return LeaveRequest::query()->latest()->get();
});


