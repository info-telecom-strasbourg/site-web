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

Route::get('/poles/cours', 'CoursController@index')->name('poles.cours.index');

// Route::get('/projets', 'ProjetController@index')->name('projets.index');
// Route::get('/projets/{projet}', 'ProjetController@show')->name('projets.show');
Route::get('/projets', function () {
	return view('projets.index');
})->name('projets.index');

Route::post('/poles/cours', 'CoursController@store')->name('poles.cours.store');

Route::get('/poles/cours/create','CoursController@create')->name('poles.cours.create');
Route::get('poles/cours/{cours}/edit', 'CoursController@edit')->name('poles.cours.edit');

Route::get('/poles/cours/{cours}', 'CoursController@show')->name('poles.cours.show');
Route::put('/poles/cours/{cours}', 'PoleController@update')->name('poles.cours.update');

Route::get('/poles/{pole}/edit', 'PoleController@edit')->name('pole.edit');
Route::get('/poles/{pole}', 'PoleController@show')->name('pole.show');
Route::put('/poles/{pole}', 'PoleController@update')->name('pole.update');

Route::get('/test', function (){
	return view('test');
});
