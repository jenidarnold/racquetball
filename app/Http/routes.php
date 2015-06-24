<?php

use App\Vote;
use App\Scraper;

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
#Route::get('players/{players}/biography', 'PlayersProfileController@getBio');
Route::get('players/{players}/journal/', 'PlayersJournalController@index');
Route::get('players/{players}/journal/{entry}', 'PlayersJournalController@show');
Route::get('players/{players}/journal/{entry}/evaluation', 'PlayersEvaluationController@index');
Route::get('players/{players}/journal/{entry}/evaluation/create', array('as' => 'evaluation.create', 'uses' => 'PlayersEvaluationController@create'));
Route::post('players/{players}/journal/{entry}/evaluation',  array('as' => 'evaluation.store', 'uses' => 'PlayersEvaluationController@store'));
Route::get('players/{players}/journal/{entry}/evaluation/{evaluation_id}', array('as' => 'evaluation.show', 'uses' => 'PlayersEvaluationController@show'));
Route::get('players/{players}/journal/{entry}/evaluation/{evaluation_id}/edit', array('as' => 'evaluation.edit', 'uses' => 'PlayersEvaluationController@edit'));
Route::post('players/{players}/journal/{entry}/evaluation/{evaluation_id}/edit', array('as' => 'evaluation.update', 'uses' => 'PlayersEvaluationController@update'));

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