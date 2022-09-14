<?php

use App\Http\Middleware\username;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Auth::routes(['verify' => true]);


Route::post('/send', [HomeController::class, 'SendMessage']);
Route::post('/signup', [HomeController::class, 'register']);
//Socilate 
Route::get('/auth/google/redirect',[HomeController::class,'redirect_google']);
Route::get('/auth/google/callback',[HomeController::class,'callback_google']);

Route::get('/MessagePrivate/{id}/{number}', [HomeController::class, 'MessagePrivate']);
Route::post('/SendMessagePrivate', [HomeController::class, 'SendMessagePrivate']);



Route::get('/profile', [UserController::class, 'index'])->Middleware([username::class]);
Route::get('/EnterUsername', [UserController::class, 'EnterUsername']);
Route::post('/AddUserName', [UserController::class, 'AddUserName']);
Route::post('/EditeImage', [UserController::class, 'UplodeImage']);

Route::Delete('/delete/{id}', [UserController::class, 'DeletePost']);



Route::get('/', function () {return view('welcome');});
Route::get('/contact', function () {return view('contact');});

