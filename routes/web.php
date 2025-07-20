<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');

Route::post('/notifications/read/{id}', function ($id) {
    $notification = auth()->user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    return back();
})->middleware('auth');
