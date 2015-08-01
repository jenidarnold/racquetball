<?php

use App\Vote;
use App\Scraper;

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('admin/scraper', ['middleware' => 'auth', 'uses' => 'Admin\ScreenScrapeController@scraper']);
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
Route::model('user', 'User');

//Need to add slug field to database tables

Route::bind('users', function($value, $route){
	return App\User::whereId($value)->first();
});

Route::bind('players', function($value, $route){
	return App\Player::wherePlayer_id($value)->first();
});

Route::bind('tournaments', function($value, $route){
	return App\Tournament::whereTournament_id($value)->first();
});

Route::bind('participants', function($value, $route){
	return App\Participant::whereTournament_id($value)->first();
});

######  User  ################
#
/* Personal Info */
Route::get('users/{user}/info/edit',  array('as' =>'link-usar', 'middleware' => 'auth', 'uses' => 'Users\UserInfoController@edit'));
Route::get('users/{user}/info/link-usar',  array('as' =>'link-usar', 'middleware' => 'auth', 'uses' => 'Users\UserInfoController@linkUsar'));

/* Preferences */
Route::get('users/{user}/preferences',  array('as' =>'user-edit-pref', 'middleware' => 'auth', 'uses' => 'Users\UserPreferencesController@edit'));


##### Players #####################
Route::get('players/{players}/tournaments', array('as' => 'player.tournaments', 'middleware' => 'auth', 'uses' => 'PlayersController@getTournaments'));
Route::get('players/{players}/biograph', 'UserAccountController@show');

Route::get('players/{players}/tournaments', array('as' => 'player.tournaments', 'middleware' => 'auth',  'uses' => 'PlayersController@getTournaments'));
Route::get('players/{players}/biography', array('as' => 'player.bio', 'middleware' => 'auth', 'uses' => 'PlayersController@getBio'));
#Route::get('players/{players}/biography', 'PlayersProfileController@getBio');

/************   Journal  ***********/
Route::get('players/{players}/journal/', array('middleware' => 'auth', 'uses' => 'PlayersJournalController@index'));
Route::get('players/{players}/journal/{entry}', array('middleware' => 'auth', 'uses' => 'PlayersJournalController@show'));
# Evaluations
Route::get('players/{players}/journal/{entry}/evaluation/{target}/', array('middleware' => 'auth', 'uses' => 'PlayersEvaluationController@index'));
Route::get('players/{players}/journal/{entry}/evaluation/{target}/{creator}/create', array('as' => 'evaluation.create', 'middleware' => 'auth', 'uses' => 'PlayersEvaluationController@create'));
Route::post('players/{players}/journal/{entry}/evaluation/{target}/{creator}',  array('as' => 'evaluation.store', 'middleware' => 'auth', 'uses' => 'Pla)yersEvaluationController@store'));
Route::get('players/{players}/journal/{entry}/evaluation/{target}/{creator}/{evaluation_id}', array('as' => 'evaluation.show', 'middleware' => 'auth', 'uses' => 'PlayersEvaluationController@show'));
Route::get('players/{players}/journal/{entry}/evaluation/{target}/{creator}/{evaluation_id}/edit', array('as' => 'evaluation.edit',  'middleware' => 'auth', 'uses' => 'PlayersEvaluationController@edit'));
Route::post('players/{players}/journal/{entry}/evaluation/{target}/{creator}/{evaluation_id}/edit', array('as' => 'evaluation.update',  'middleware' => 'auth', 'uses' => 'PlayersEvaluationController@update'));
# Opponents

Route::get('players/{players}/journal/{entry}/opponent', 'PlayersOpponentController@index');
Route::get('players/{players}/journal/{entry}/opponent/create', array('as' => 'opponent.create',  'middleware' => 'auth', 'uses' => 'PlayersOpponentController@create'));
Route::get('players/{players}/journal/{entry}/opponent/{target_id}', array('as' => 'opponent.evaluation.store',  'middleware' => 'auth', 'uses' => 'PlayersEvaluationController@store'));
Route::post('players/{players}/journal/{entry}/opponent',  array('as' => 'opponent.store',  'middleware' => 'auth', 'uses' => 'PlayersOpponentController@store'));
Route::get('players/{players}/journal/{entry}/opponent/{player_id}', array('as' => 'opponent.show',  'middleware' => 'auth', 'uses' => 'PlayersOpponentController@show'));
Route::get('players/{players}/journal/{entry}/opponent/{player_id}/edit', array('as' => 'opponent.edit',  'middleware' => 'auth', 'uses' => 'PlayersOpponentController@edit'));
Route::post('players/{players}/journal/{entry}/opponent/{player_id}/edit', array('as' => 'opponent.update', 'middleware' => 'auth',  'uses' => 'PlayersOpponentController@update'));
Route::get('players/{players}/journal/{entry}/opponent/{player_id}/evaluate', array('as' => 'opponent.update',  'middleware' => 'auth', 'uses' => 'PlayersOpponentController@evaluate'));


Route::resource('users', 'UserController');
Route::resource('rankings', 'RankingsController');
Route::resource('players', 'PlayersController');
Route::resource('tournaments', 'TournamentsController');
Route::resource('tournaments.participants', 'ParticipantsController');
Route::resource('tournaments.divisions', 'DivisionsController');
//Route::resource('tournaments.divisions.participaints', 'ParticipantsController');

//APIs
Route::get('api/profile/download', function(){
	$player_id = (int)Input::get('playerID');

//dd($player_id);
	//call scraper
	$s = New Scraper();
	$s->get_player($player_id);

	return "";
});

Route::get('api/profile/image', function(){
	$player_id = (int)Input::get('playerID');

	if (get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player_id.'_normal.jpg')[0] 
	 	!= 'HTTP/1.1 404 Not Found'){
	 	$profile = 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player_id.'_normal.jpg'; 
	}
	else {
		$profile = '/images/racquet-right.png';
	}

	return $profile;
});

Route::get('api/vote/castvote', function(){
	$skill_id = (int)Input::get('skillID');
	$voter_id = (int)Input::get('voterID');
	$for_id = (int)Input::get('forID');
	$against_id = (int)Input::get('againstID');
	
	//if $sameVote exists, do nothing
	$sameVote = Vote::where('voter_id', '=', $voter_id)
		->where('skill_id', '=', $skill_id)
		->where('for_id', '=', $for_id)
		->where('against_id', '=', $against_id)
		->count();

	if ($sameVote == 0) {
		$vote = Vote::firstOrNew(array(
			'voter_id' => $voter_id,
			'skill_id' => $skill_id,
			'for_id' => $against_id,
			'against_id' => $for_id,
			)
		);		

		$vote->voter_id = $voter_id;
		$vote->skill_id = $skill_id;
		$vote->for_id = $for_id;
		$vote->against_id = $against_id;
		$vote->save();
	}

	// get the reults
	$p1 = Vote::head2head($skill_id,$for_id,$against_id );
	$p2 = Vote::head2head($skill_id,$against_id,$for_id );

	$versus = array(
		"p1" => $p1,
		"p2" => $p2
		);

	//dd($versus);
	return Response::json($versus);
});