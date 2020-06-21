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

Route::get('/projets', 'ProjetController@index')->name('projet.index');
Route::get('/projet/create', 'ProjetController@create')->name('projet.create');
Route::post('/projet/create', 'ProjetController@store')->name('projet.store');
Route::get('/projet/edit/{projet}', 'ProjetController@edit')->name('projet.edit');
Route::patch('/projet/edit', 'ProjetController@update')->name('projet.update');
Route::delete('/projet/delete/{id}', 'ProjetController@destroy')->name('projet.destroy');
Route::get('/projet/{projet}', 'ProjetController@show')->name('projet.show');
