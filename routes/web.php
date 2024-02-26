<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $message = "<h1>Prex Challenge</h1>";
    $message .= "<p>Github Repository <a href='https://github.com/pmirand6/prex-challenge'>Here</a> </p>";
    return $message;
});
