<?php

use App\Vote;
use App\Scraper;
use App\User;
use App\Player;
use App\Ranking;
use App\Location;

Route::get('vuetest', function(){
	return view('pages/players/journal/vue');
});

Route::get('/', 'WelcomeController@index');
Route::get('home', ['uses' => 'HomeController@index']);

Route::group(['namespace' => 'Admin', 'prefix' =>'admin'], function()
{
	Route::get('scraper', ['middleware' => 'auth', 'uses' => 'ScreenScrapeController@scraper']);
	//Route::get('admin/rankings', 'Admin\ScreenScrapeController@rankings');
	Route::get('rankings', array('as' => 'download_rankings', 'uses' => 'ScreenScrapeController@rankings'));
	Route::get('tournaments', array('as' => 'download_tournaments', 'uses' => 'ScreenScrapeController@tournaments'));
	Route::get('participants', array('as' => 'download_participants', 'uses' => 'ScreenScrapeController@participants'));
	Route::get('player', array('as' => 'download_player', 'uses' => 'ScreenScrapeController@player'));
	Route::get('matches', array('as' => 'download_matches', 'uses' => 'ScreenScrapeController@matches'));
});

Route::group(['namespace' => 'Tools', 'prefix' =>'tools'], function()
{
	// League
	Route::get('league', array('as' => 'tools.league', 'uses' => 'LeagueController@index'));	
	Route::get('league/create', array('as' => 'tools.league.create', 'uses' => 'LeagueController@create'));
	Route::post('league/store', array('as' => 'tools.league.store',  'uses' =>  'LeagueController@store'));
	Route::get('league/{league_id}/', array('as' => 'tools.league.show', 'uses' => 'LeagueController@show'));
	Route::get('league/{league_id}/standings', array('as' => 'tools.league.show', 'uses' => 'LeagueController@standings'));
	Route::get('league/{league_id}/join', array('as' => 'tools.league.join', 'uses' => 'LeagueController@join'));
	Route::put('league/{league_id}/join', array('as' => 'tools.league.join', 'uses' => 'LeagueController@addPlayer'));
	Route::get('league/{league_id}/edit', array('as' => 'tools.league.edit', 'uses' => 'LeagueController@edit'));
	Route::post('league/{league_id}/edit', array('as' => 'tools.league.edit', 'uses' => 'LeagueController@update'));

	// League Match
	Route::get('league/{league_id}/match/create', array('as' => 'tools.league.match.create', 'uses' => 'LeagueController@createMatch'));
	Route::post('league/{league_id}/match/store', array('as' => 'tools.league.match.store', 'uses' => 'LeagueController@storeMatch'));
	Route::get('league/{league_id}/match/{match_id}/edit', array('as' => 'tools.league.match.edit', 'uses' => 'LeagueController@editMatch'));
	Route::put('league/{league_id}/match/{match_id}/update', array('as' => 'tools.league.match.update', 'uses' => 'LeagueController@updateMatch'));
	Route::delete('league/{league_id}/match/{match_id}/destroy', array('as' => 'tools.league.match.delete', 'uses' => 'LeagueController@destroyMatch'));
	
	// League API
	Route::get('league/api/players/count', 'LeagueController@getPlayerCount');
	Route::get('league/api/players/streak', 'LeagueController@getPlayerStreak');

	//Referee
	Route::get('referee', 'RefereeController@index');

	//Shot Selection
	Route::get('shotselection', 'ShotSelectionController@index');

	//Doubles Matchmaker
	Route::get('doublesmatcher', 'Matchmaker\MatchmakerController@index');
	Route::get('doublesmatcher/api/questions', 'Matchmaker\QuestionsController@index');
	Route::get('doublesmatcher/api/answers', 'Matchmaker\AnswersController@index');
	Route::get('doublesmatcher/api/players', 'Matchmaker\PlayersController@players');
	Route::get('doublesmatcher/api/players/{player_id}/answers', 'Matchmaker\PlayersController@answersByPlayer');
	Route::get('doublesmatcher/api/players/answers', 'Matchmaker\PlayersController@answers');
	Route::post('doublesmatcher/api/players/answers/save', 'Matchmaker\PlayersController@storePlayerAnswers');
});


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
Route::group(['namespace' => 'Users', 'prefix' => 'users/{user_id}'], function()
{
	/* Personal Info */
	Route::get('info/show',  array('as' =>'user-show-info', 'uses' => 'UserInfoController@show'));
	Route::get('info/name/edit',  array('as' =>'user-edit-info', 'uses' => 'UserInfoController@edit_name'));
	Route::get('info/email/edit',  array('as' =>'user-edit-info', 'uses' => 'UserInfoController@edit_email'));
	Route::get('info/phone/edit',  array('as' =>'user-edit-info', 'uses' => 'UserInfoController@edit_phone'));
	Route::get('info/address/edit',  array('as' =>'user-edit-info', 'uses' => 'UserInfoController@edit_address'));
	Route::get('info/link-usar/show',  array('as' =>'show-link-usar', 'uses' => 'UserInfoController@show_linkUsar'));
	Route::post('info/link-usar/edit',  array('as' =>'edit-link-usar', 'uses' => 'UserInfoController@edit_linkUsar'));

	/* Preferences */
	Route::get('preferences',  array('as' =>'user-edit-pref', 'uses' => 'Users\UserPreferencesController@edit'));
});

##### Players #####################
Route::group(['prefix' => 'players/{players}'], function()
{
	Route::get('tournaments', array('as' => 'player.tournaments', 'uses' => 'PlayersController@getTournaments'));
	#Route::get('biography', 'Users\UserAccountController@show');

	Route::get('tournaments', array('as' => 'player.tournaments', 'uses' => 'PlayersController@getTournaments'));
	Route::get('biography', array('as' => 'player.bio', 'uses' => 'PlayersController@getBio'));
	#Route::get('biography', 'PlayersProfileController@getBio');

	/************   Journal  ***********/
	Route::get('evaluation/invite', array('as' => 'evaluation.invite', 'uses' => 'PlayersEvaluationController@invite'));
	Route::post('evaluation/invite', array('as' => 'evaluation.invite.update', 'uses' => 'PlayersEvaluationController@request'));

	Route::get('journal/', array('uses' => 'PlayersJournalController@index'));
	Route::get('journal/{entry}', array('uses' => 'PlayersJournalController@show'));
	# Evaluations
	Route::get('journal/{entry}/evaluation/{target}/', array('uses' => 'PlayersEvaluationController@index'));
	Route::get('journal/{entry}/evaluation/{target}/{creator}/create', array('as' => 'evaluation.create', 'uses' => 'PlayersEvaluationController@create'));
	Route::post('journal/{entry}/evaluation/{target}/{creator}',  array('as' => 'evaluation.store', 'uses' => 'PlayersEvaluationController@store'));
	Route::get('journal/{entry}/evaluation/{target}/{creator}/{evaluation_id}', array('as' => 'evaluation.show', 'uses' => 'PlayersEvaluationController@show'));
	Route::get('journal/{entry}/evaluation/{target}/{creator}/{evaluation_id}/edit', array('as' => 'evaluation.edit', 'uses' => 'PlayersEvaluationController@edit'));
	Route::post('journal/{entry}/evaluation/{target}/{creator}/{evaluation_id}/edit', array('as' => 'evaluation.update', 'uses' => 'PlayersEvaluationController@update'));

	# Opponents
	Route::group(['prefix' => 'journal/{entry}'], function()
	{
		Route::get('opponent', 'PlayersOpponentController@index');
		Route::get('opponent/create', array('as' => 'opponent.create', 'uses' => 'PlayersOpponentController@create'));
		Route::get('opponent/{target_id}', array('as' => 'opponent.evaluation.store', 'uses' => 'PlayersEvaluationController@store'));
		Route::post('opponent',  array('as' => 'opponent.store', 'uses' => 'PlayersOpponentController@store'));
		Route::get('opponent/{player_id}', array('as' => 'opponent.show', 'uses' => 'PlayersOpponentController@show'));
		Route::get('opponent/{player_id}/edit', array('as' => 'opponent.edit', 'uses' => 'PlayersOpponentController@edit'));
		Route::post('opponent/{player_id}/edit', array('as' => 'opponent.update', 'uses' => 'PlayersOpponentController@update'));
		Route::get('opponent/{player_id}/evaluate', array('as' => 'opponent.update', 'uses' => 'PlayersOpponentController@evaluate'));
	});
});

Route::resource('users', 'UserController');
Route::resource('rankings', 'RankingsController');
Route::resource('players', 'PlayersController');
Route::resource('tournaments', 'TournamentsController');
Route::resource('tournaments.participants', 'ParticipantsController');
Route::resource('tournaments.divisions', 'DivisionsController');

// Socialites (facebook)

// Redirect to github to authenticate
Route::get('github', 'AccountController@github_redirect');
// Get back to redirect url
Route::get('account/github', 'AccountController@github');
// Redirect to facebook to authenticate
Route::get('facebook', 'AccountController@facebook_redirect');
// Get back to redirect url
Route::get('account/facebook', 'AccountController@facebook');

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

Route::get('api/rankings/history', function(){
	$player_id = (int)Input::get('player_id');
	$group_id = Input::get('group_id');	
	$location_id = (int)Input::get('location_id');
	$location = Location::find($location_id);
	$player = Player::find($player_id);

	$rankings = Ranking::where('player_id', '=', $player_id)
		->select('ranking_date',  'location_id', 'ranking')
		->orderBy('ranking_date')
		->get();

	/*National Ranking*/
	$national = Ranking::where('player_id', '=', $player_id)
		->where('location_id', '=', 0)
		->select('ranking_date',  'ranking')
		->orderBy('ranking_date')
		->get();

	$query = "
		SELECT 
			date_format(ranking_date, '%m/%d/%Y') as ranking_date,
			ranking
		FROM
			rankings
		WHERE
			player_id = $player_id
			AND location_id = 0
			AND group_id = $group_id
		ORDER BY 
			ranking_date
		";

	$national = \DB::select(DB::raw($query)); 
	$arr_national = array();
	foreach ($national as $key => $n) {
		$row = array();
		$row['ranking_date'] = $n->ranking_date;
		$row['National'] = intval($n->ranking);
		array_push($arr_national, $row);
	}


	//dd($player);

	/*State Ranking*/
	$query = "
		SELECT 
			date_format(ranking_date, '%m/%d/%Y') as ranking_date,
			ranking
		FROM
			rankings
		WHERE
			player_id = $player_id
			AND group_id = $group_id
			AND location_id = $location_id
		ORDER BY 
			ranking_date
		";

	$state = \DB::select(DB::raw($query)); 
	$arr_state = array();
	foreach ($state as $key => $n) {
		$row = array();
		$row['ranking_date'] = $n->ranking_date;
		$row["$location->location"] = intval($n->ranking);
		array_push($arr_state, $row);
	}

	/*Compare closest 3 rankings */
    /*get compare player ranking above*/
	$query_player1_id = "
		SELECT 
			player_id
		FROM
			rankings
		WHERE
			location_id = $location_id
			AND group_id = $group_id
			and ranking < $player->state_rank
		ORDER BY 
			ranking_date DESC, ranking DESC
		LIMIT 1
		";
	$compare_player_1 = Player::find(\DB::select(DB::raw($query_player1_id))[0]->player_id);

    /*get compare2 id */
    /*get compare player ranking below*/

	$query_player2_id = "
		SELECT 
			player_id
		FROM
			rankings
		WHERE
			location_id = $location_id
			AND group_id = $group_id
			and ranking > $player->state_rank
		ORDER BY 
			ranking_date DESC, ranking 
		LIMIT 1
		";

	$compare_player_2 = Player::find(\DB::select(DB::raw($query_player2_id))[0]->player_id);

    /*get comare 1 player history */
	$query_compare = "
		SELECT 
			*
		FROM
			(
				SELECT 
					date_format(ranking_date, '%m/%d/%Y') as ranking_date,
					ranking as my_ranking
				FROM
					rankings
				WHERE
					player_id = $player_id
					AND group_id = $group_id
					AND location_id = $location_id
			) as p1
		INNER JOIN
			(
				SELECT 
					date_format(ranking_date, '%m/%d/%Y') as ranking_date,
					ranking as c1_ranking
				FROM
					rankings
				WHERE
					player_id = $compare_player_1->player_id
					AND group_id = $group_id
					AND location_id = $location_id
			) as p2
		ON p1.ranking_date = p2.ranking_date
		INNER JOIN
			(
				SELECT 
					date_format(ranking_date, '%m/%d/%Y') as ranking_date,
					ranking as c2_ranking
				FROM
					rankings
				WHERE
					player_id = $compare_player_2->player_id
					AND group_id = $group_id
					AND location_id = $location_id
			) as p3 
		ON p2.ranking_date = p3.ranking_date	
		ORDER BY 
			p1.ranking_date
		";


	$compare = \DB::select(DB::raw($query_compare)); 

	$arr_compare = array();
	/* Add players history*/
	foreach ($compare as $key => $n) {
		$row = array();
		$row['ranking_date'] = $n->ranking_date;
		$row["$compare_player_1->first_name"] = intval($n->c1_ranking);
		$row["$player->first_name"] = intval($n->my_ranking);
		$row["$compare_player_2->first_name"] = intval($n->c2_ranking);
		array_push($arr_compare, $row);
	}
	
 	$rankings = [
		"National" => $arr_national,
	  	"State" => $arr_state,
	  	"Compare" => $arr_compare
	];
	return $rankings;
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