<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('admin/scraper', 'Admin\ScreenScrapeController@scraper');
Route::get('admin/rankings', 'Admin\ScreenScrapeController@rankings');
Route::get('admin/tournaments', 'Admin\ScreenScrapeController@tournaments');
//Route::get('admin/participants', 'Admin\ScreenScrapeController@participants');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'scraper' => 'Admin\ScreenScrapeController',
]);

Route::resource('rankings', 'RankingsController');
Route::resource('players', 'PlayersController');
Route::resource('tournaments', 'TournamentsController');
Route::resource('tournaments.divisions', 'DivisionsController');
//Route::resource('tournaments.divisions.participaints', 'ParticipantsController');

Route::bind('players', function($value, $route){
	return App\Player::whereSlug($value)->first();
});

Route::bind('tournaments', function($value, $route){
	return App\Tournament::whereSlug($value)->first();
});



