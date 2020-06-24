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

Route::get('/poles/cours', 'CoursController@index')->name('poles.cours.index');


/*########## Cours ########## */
Route::post('/poles/cours', 'CoursController@store')->name('poles.cours.store');

Route::get('/poles/cours/create','CoursController@create')->name('poles.cours.create')->middleware('can:create,App\Cours');
Route::get('poles/cours/{cours}/edit', 'CoursController@edit')->name('poles.cours.edit')->middleware('can:update,cours');

Route::get('/poles/cours/{cours}', 'CoursController@show')->name('poles.cours.show');
Route::put('/poles/cours/{cours}', 'CoursController@update')->name('poles.cours.update')->middleware('can:update,cours');



/*########## Poles compétitions ########## */
Route::post('/poles/compétitions', 'CompetitionController@store')->name('poles.competitions.store');
Route::get('/poles/compétitions', 'CompetitionController@index')->name('poles.competitions.index');
Route::get('/poles/compétition/create','CompetitionController@create')->name('poles.competitions.create');
Route::get('/poles/compétition/{competition}', 'CompetitionController@show')->name('poles.competitions.show');
Route::get('/poles/compétition/{competition}/edit', 'CompetitionController@edit')->name('poles.competitions.edit');
Route::put('/poles/compétition/{competition}', 'CompetitionController@update')->name('poles.competitions.update');


Route::get('/poles/{pole}', 'PoleController@show')->name('pole.show');
Route::put('/poles/{pole}', 'PoleController@update')->name('pole.update');
Route::get('/poles/{pole}/edit', 'PoleController@edit')->name('pole.edit');

/*########## Download ########## */
Route::get('/download/{path}', 'CoursController@downloadFile');




Route::get('/test', function (){
	return view('test');
});

/***** Route projets *****/
Route::resources([
    'projets' => "ProjetController"
]);

/***** Route users *****/
Route::get('/users', 'UserController@index')->name('users.index');
// Route::get('/users/{user}', 'UserController@show')->name('users.show');
