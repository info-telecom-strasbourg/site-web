<?php

use Illuminate\Support\Facades\Route;

use App\Cours;
use App\Pole;
use App\Http\Controllers\ServersStatsController;

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

Route::get('/', 'WelcomeController@welcome')->name('welcome');
Route::post('/contact', 'WelcomeController@store')->middleware(['honey', 'honey-recaptcha'])->name('welcome.store');

/***** Route besoin d'aide *****/
Route::get('/besoin-aide', function () {
    return view('besoin-aide');
});

Route::post('/besoin-aide', 'BesoinAideController@store')->name('aide.store');

Route::get('/page-admin/vue-ensemble', 'AdminVueEnsembleController@getRessources')->middleware('admin');
Route::get('/page-admin/membres', 'AdminMembresController@getRessources')->middleware('admin');
Route::get('/page-admin/actualites', 'AdminActualitesController@getRessources')->middleware('admin');
Route::put('/page-admin/user/{user}/edit', 'AdminMembresController@updateUser')->middleware('admin');
Route::get('/page-admin/{user}/delete-user', 'AdminMembresController@deleteUser')->middleware('admin');
Route::get('/page-admin/delete-news/{news}', 'AdminActualitesController@destroy')->middleware('admin');
Route::post('/page-admin/news/create', 'AdminActualitesController@store')->middleware('admin');


Route::put('/page-admin/news/{news}/edit', 'AdminActualitesController@update')->middleware('admin');

Auth::routes();

Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('admin');

Route::get('/home', 'HomeController@index')->name('home');

/***** Route poles *****/
Route::get('/poles/cours', 'CoursController@index')->name('poles.cours.index');


/*########## Cours ########## */
Route::post('/poles/cours', 'CoursController@store')->name('poles.cours.store');

Route::get('/poles/cours/create','CoursController@create')->name('poles.cours.create');
Route::get('/poles/cours/{cours}/edit', 'CoursController@edit')->name('poles.cours.edit');
Route::get('/poles/cours/{cours}/destroy', 'CoursController@destroy')->name('poles.cours.delete');

Route::get('/poles/cours/{cours}', 'CoursController@show')->name('poles.cours.show');
Route::put('/poles/cours/{cours}', 'CoursController@update')->name('poles.cours.update');



/*########## Poles compétitions ########## */
Route::post('/poles/competitions', 'CompetitionController@store')->name('poles.competitions.store');
Route::get('/poles/competitions', 'CompetitionController@index')->name('poles.competitions.index');
Route::get('/poles/competitions/create','CompetitionController@create')->name('poles.competitions.create');
Route::get('/poles/competitions/{compet}/edit', 'CompetitionController@edit')->name('poles.competitions.edit');
Route::get('/poles/competitions/{compet}/destroy', 'CompetitionController@destroy')->name('poles.competitions.delete');
Route::put('/poles/competitions/{compet}', 'CompetitionController@update')->name('poles.competitions.update');
Route::get('/poles/competitions/{compet}', 'CompetitionController@show')->name('poles.competitions.show');


Route::get('/poles/{pole}', 'PoleController@show')->name('poles.show');
Route::put('/poles/{pole}', 'PoleController@update')->name('poles.update');
Route::get('/poles/{pole}/edit', 'PoleController@edit')->name('poles.edit');

/*########## Download ########## */
Route::get('/download/{path}', 'CoursController@downloadFile');




Route::get('/test', function (){ return view('test'); });

/***** Route projets *****/
Route::resources(['projets' => "ProjetController"]);
Route::get('/projets/create','ProjetController@create')->name('projets.create')->middleware('can:create, App\Projet');

/***** Route users *****/
Route::get('/users', 'UserController@index')->name('users.index');
Route::put('/users/{user}', 'UserController@update')->name('users.update');
Route::get('/users/{user}', 'UserController@show')->name('users.show');
 
/***** Route topics *****/
Route::resource('topics', 'TopicController');

/***** Route comments *****/
Route::post('/comments/{topic}', 'CommentController@store')->name('comments.store');
Route::post('/comments/poles/cours/{cours}', 'CommentController@storeCours')->name('comments.poles.cours.store');
Route::post('/comments/poles/competition/{compet}', 'CommentController@storeCompetition')->name('comments.poles.competition.store');
Route::post('/comments/poles/pole/{pole}', 'CommentController@storePole')->name('comments.poles.pole.store');
Route::post('/comments/projets/{projet}', 'CommentController@storeProject')->name('comments.projets.store');
Route::post('/commentsReply/{comment}', 'CommentController@storeCommentReply')->name('comments.storeReply');
Route::put('/comments/{comment}', 'CommentController@update')->name('comments.update');
Route::get('/comments/{comment}/destroy', 'CommentController@destroy')->name('comments.delete');

/***** Route timeline ****/
Route::put('/timeline/{step}/edit', 'TimelineEventController@update');
Route::post('/timeline/create/{id}', 'TimelineEventController@store');
Route::get('/timeline/{step}/destroy', 'TimelineEventController@destroy');

Route::post('/users/{user}/avatar', 'UserController@update_avatar');
Route::post('/users/{user}/search', 'UserController@search');


/***** Route stats serveurs *****/
Route::get('/servers-stats', 'ServersStatsController@stats');
Route::get('/servers-status', function () {
    return view('servers-status');
});