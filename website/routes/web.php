<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/besoin-aide', function () {
    return view('besoin-aide');
});

Route::get('/page-admin', function () {
    return view('dark-page');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
