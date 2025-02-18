<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $user = auth()->user();
    return view('home',compact('user'));
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/profile', [UserController::class,'profile']);
Route::get('/signup', [UserController::class,'signup']);
Route::get('/login', [UserController::class,'login']);
Route::post('/signup', [UserController::class,'signup']);
Route::post('/logout', [UserController::class,'logout']);
Route::post('/login', [UserController::class,'login']);
