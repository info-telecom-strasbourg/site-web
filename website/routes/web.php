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
})->middleware('admin');

Auth::routes();

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('admin');

Route::get('/home', 'HomeController@index')->name('home');

/***** Route poles *****/
Route::get('/poles', 'PoleController@index')->name('pole.index');
Route::get('/poles/{pole}', 'PoleController@show')->name('pole.show');

/***** Route projets *****/
Route::resources([
    'projets' => "ProjetController"
]);

/***** Route users *****/
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}', 'UserController@show')->name('users.show');
