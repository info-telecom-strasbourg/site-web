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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/poles', 'PoleController@index')->name('pole.index');
Route::get('/poles/{pole}', 'PoleController@show')->name('pole.show');
Route::get('/poles/{pole}/edit', 'PoleController@edit')->name('pole.edit');

// Route::get('/projets', 'ProjetController@index')->name('projets.index');
// Route::get('/projets/{projet}', 'ProjetController@show')->name('projets.show');
Route::get('/projets', function () {
	return view('projets.index');
})->name('projets.index');

Route::get('/cours', function () {
	return view('poles.cours.index');
})->name('cours.index');

Route::get('/cours/{cours}', 'CoursController@show')->name('cours.show');
