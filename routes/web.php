<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ex1', [TestController::class, 'Ex1']);
Route::get('/ex2', [TestController::class, 'Ex2']);
Route::get('/ex3', [TestController::class, 'Ex3']);
Route::get('/ex4', [TestController::class, 'Ex4']);
Route::get('/ex5', [TestController::class, 'Ex5']);
Route::get('/ex6', [TestController::class, 'Ex6']);
Route::get('/ex7', [TestController::class, 'Ex7']);
Route::get('/ex8', [TestController::class, 'Ex8']);
Route::get('/ex9', [TestController::class, 'Ex9']);
Route::get('/ex10', [TestController::class, 'Ex10']);
