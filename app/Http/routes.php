<?php

use DB;
use App\Vote;

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('admin/scraper', 'Admin\ScreenScrapeController@scraper');
//Route::get('admin/rankings', 'Admin\ScreenScrapeController@rankings');
Route::get('admin/rankings', array('as' => 'download_rankings', 'uses' => 'Admin\ScreenScrapeController@rankings'));
Route::get('admin/tournaments', 'Admin\ScreenScrapeController@tournaments');
Route::get('admin/participants', array('as' => 'download_participants', 'uses' => 'Admin\ScreenScrapeController@participants'));
Route::get('admin/player', array('as' => 'download_player', 'uses' => 'Admin\ScreenScrapeController@player'));
Route::get('admin/matches', array('as' => 'download_matches', 'uses' => 'Admin\ScreenScrapeController@matches'));


Route::get('matchups', 'MatchupsController@index');
Route::post('matchups', 'MatchupsController@show');
//Route::get('admin/participants/create', 'Admin\ScreenScrapeController@participants');
//Route::get('admin/participants/{tournament_id}', 'Admin\ScreenScrapeController@participants');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'scraper' => 'Admin\ScreenScrapeController',
]);



Route::model('participants', 'Participant');
Route::model('tournaments', 'Tournament');
Route::model('players', 'Player');



//Need to add slug field to database tables
Route::bind('players', function($value, $route){
	return App\Player::wherePlayer_id($value)->first();
});

Route::bind('tournaments', function($value, $route){
	return App\Tournament::whereTournament_id($value)->first();
});

Route::bind('participants', function($value, $route){
	return App\Participant::whereTournament_id($value)->first();
});


Route::get('players/{players}/tournaments', 'PlayersController@getTournaments');
Route::get('players/{players}/biography', 'PlayersController@getBio');

Route::resource('rankings', 'RankingsController');
Route::resource('players', 'PlayersController');
Route::resource('tournaments', 'TournamentsController');
Route::resource('tournaments.participants', 'ParticipantsController');
Route::resource('tournaments.divisions', 'DivisionsController');
//Route::resource('tournaments.divisions.participaints', 'ParticipantsController');

//APIs
Route::get('api/vote/castvote', function(){
	$skill_id = (int)Input::get('skillID');
	$voter_id = (int)Input::get('voterID');
	$for_id = (int)Input::get('forID');
	$against_id = (int)Input::get('againstID');
	
	//1. if exists delete vote by voterid, skillid, forid, againstid
	//2. store new vote by voterid, skillid, forid, againstid
	//3. get the reults
	$p1 = Vote::head2head($skill_id,$for_id,$against_id );
	$p2 = Vote::head2head($skill_id,$against_id,$for_id );

	$versus = array(
		"p1" => $p1,
		"p2" => $p2
		);

	//dd($versus);
	return Response::json($versus);
});