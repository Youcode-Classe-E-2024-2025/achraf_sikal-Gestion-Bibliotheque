<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

$user = auth()->user();
session()->put("user", $user);


Route::resource('books', HomeController::class);

Route::post('/books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');

Route::get('/', [HomeController::class,'index']);
Route::get('/borrowed', [BookController::class,'userBorrows']);
Route::get('/books', [BookController::class,'index']);
Route::get('/explore', [BookController::class,'explore']);
Route::resource('books', BookController::class);
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
