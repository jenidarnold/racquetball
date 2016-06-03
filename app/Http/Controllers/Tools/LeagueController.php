<?php namespace App\Http\Controllers\Tools;

use Input;
use App\Player;
use App\League;
use App\Match;
use App\Game;
use App\MatchGame;
use App\GameFormat;
use App\GymLocation;
use App\LeaguePlayer;
use App\LeagueMatch;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\User;
use Validator;

class LeagueController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//grid
		$leagues = \DB::table('leagues')
				->orderby('start_date', 'desc')
				->orderby('name')
				->paginate(10);
			
		return view('pages/tools.league.index', compact('leagues'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$gyms = GymLocation::orderby('name')->get();
		$gyms = $gyms->lists('name', 'id');

		$formats = New GameFormat;

		//dropdown list
		$directors = Player::orderby('last_name')->orderby('first_name')->get();
		$directors = $directors->lists('last_first_name', 'player_id');
		
		return view('pages/tools.league.create', compact('gyms', 'formats', 'directors'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
  		//validate
        //read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'leageue_title'       => 'required',
            'start_date'      => 'required',
            'end_date' => 'required',
            'format_id' => 'required',
            'director_id' => 'required',
            'gym_id' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        // if ($validator->fails()) {
        // 	dump($validator);
        //     return Redirect::route('tools.league.create')
        //         ->withErrors($validator)
        //         ->withInput();
        // } else {
        //     // store
            $league = new League;
            $league->name       = Input::get('league_title');
            $league->start_date = Input::get('start_date');
            $league->end_date 	= Input::get('end_date');
            $league->save();
		//}
        // redirect
        \Session::flash('message', 'Successfully created league!');      

		return Redirect::route('tools.league');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($league_id)
	{
		$league = New League;

		$league = $league->find($league_id);

		$players = \DB::table('league_players')
				->join('players','players.player_id', '=', 'league_players.player_id')
				->where('league_id', '=', $league_id)
				->orderby('last_name')
				->orderby('first_name');


		$matches = \DB::table('league_matches')
				->join('matches','league_matches.match_id', '=', 'matches.match_id')
				->join('players as p1','p1.player_id', '=', 'matches.player1_id')
				->join('players as p2','p2.player_id', '=', 'matches.player2_id')				
				//->leftjoin('rankings as r1','r1.player_id', '=', 'matches.player1_id')
				//->leftjoin('rankings as r2','r2.player_id', '=', 'matches.player2_id')
				->where('league_id', '=', $league_id)
				->select( '*',
					'p1.first_name as p1_first_name', 				
				 	'p1.last_name as p1_last_name' ,
				//	'r1.ranking as p1_rank',
					'p2.first_name as p2_first_name', 
					'p2.last_name as p2_last_name'
				//	'r2.ranking as p2_rank'
				)				
				->distinct()
				->orderby('matches.match_id')
				->get();

		$p1_standings = \DB::table('league_matches')
				->join('matches','league_matches.match_id', '=', 'matches.match_id')
				->join('players as p1','p1.player_id', '=', 'matches.player1_id')
				->join('match_games','match_games.match_id', '=', 'matches.match_id')			
				->join('games as g','g.id', '=', 'match_games.game_id')
				->where('league_id', '=', $league_id)
				->select( 
					'player_id',
					'first_name', 				
				 	'last_name' 
					)	
				->addSelect(\DB::raw('sum(score1) as score_total'))
				->addSelect(\DB::raw('count(score1) as game_total'))
				->groupby('p1.player_id');
				
		$p2_standings = \DB::table('league_matches')
				->join('matches','league_matches.match_id', '=', 'matches.match_id')
				->join('players as p2','p2.player_id', '=', 'matches.player2_id')
				->join('match_games','match_games.match_id', '=', 'matches.match_id')			
				->join('games as g','g.id', '=', 'match_games.game_id')
				->where('league_id', '=', $league_id)
				->select( 
					'player_id',
					'first_name', 				
				 	'last_name' 
					)	
				->addSelect(\DB::raw('sum(score2) as score_total'))
				->addSelect(\DB::raw('count(score2) as game_total'))
				->groupby('p2.player_id');
			
		//$standings = $p1_standings->union($p2_standings)->get();

		$standings = \DB::select(
			\DB::raw(
				"SELECT 
					player_id, 
					first_name, 				
					last_name, 
					sum(points) as points, 
					sum(games) as games,
					TRUNCATE(sum(points)/sum(games), 1) as avg			
				FROM 
					(
					SELECT 
					    p1.player_id as player_id,
						first_name, 				
					 	last_name, 
						sum(score1) as points,
						count(score1) as games
					from 
						matches 
						join league_matches on league_matches.match_id = matches.match_id
						join players as p1 on p1.player_id = matches.player1_id
						join match_games as mg on mg.match_id = matches.match_id
						join games as g on g.id = mg.game_id
					where 
					    league_id = $league_id
					group by 
					    player_id
					UNION ALL
					SELECT 
					    p2.player_id as player_id,
						first_name, 				
					 	last_name, 
						sum(score2) as points,
						count(score2) as games
					from 
						matches 
						join league_matches on league_matches.match_id = matches.match_id
						join players as p2 on p2.player_id = matches.player2_id
						join match_games as mg on mg.match_id = matches.match_id
						join games as g on g.id = mg.game_id
					where 
					    league_id = $league_id
					group by 
					    player_id 
					 ) as T
				group by 
					    first_name, 				
					 	last_name, 
					 	player_id 
				order by cast(sum(points) /sum(games) as decimal(10,2)) desc
				"
				)
			);
				
		//dd($standings);
		//dropdown list
		//$players_list = Player::orderby('last_name')->orderby('first_name')->get();
		//$players_list = $players_list->lists('last_first_name', 'player_id');
		
		//DB::table('customers')->select(DB::raw('concat (first_name," ",last_name) as full_name,id'))->lists('full_name', 'id');

		$players_list = $players->select(\DB::raw('concat (last_name, ", ", first_name) as last_first_name, players.player_id'))
			->lists('last_first_name', 'player_id');

		//Empty objects used to get Scores
		$match = New MatchGame();
		$game = New Game();


		return view('pages/tools.league.show', compact('league', 'players', 'standings', 'matches', 'match', 'game', 'players_list'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function join($league_id)
	{

		$league = New League;
		$league = $league->find($league_id);

		$players = $league->getPlayers($league_id)
			->orderby('last_name')
			->orderby('first_name')
			->get();

		//$players = Player::orderby('last_name')->orderby('first_name')->get();

		//dropdown list
		$players_list = Player::orderby('last_name')->orderby('first_name')->get();
		$players_list = $players_list->lists('last_first_name', 'player_id');
		
		//dd($players_list);

		return view('pages/tools.league.join', compact('league', 'players', 'players_list'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function addPlayer(Request $request)
	{

		$player = New Player;

		$league_id = Input::get('league_id');
		$player_id = Input::get('player_id');

		// Player already exists?
		if (! is_null($player_id) ) {
			$player = Player::find($player_id);

		} //Create new player profile
		else {
			$user = New User;
		 	$user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->save();

            $player = New Player;
		 	$player->first_name = Input::get('first_name');
            $player->last_name = Input::get('last_name');
            $player->player_id = $user->id;
            $player->save();
        }

        //Insert into league        
        if ($player->player_id > 0) {
        	$league_player = new LeaguePlayer;

        	$league_player->player_id = $player->player_id;
        	$league_player->league_id = $league_id;
        	$league_player->save();
        }

		return \Redirect::route('tools.league.join', array($league_id));
		//return Redirect::action('LeagueController@join', compact('league_id'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function addMatch(Request $request)
	{

		$player = New Player;

		$league_id = Input::get('league_id');
		$match_date = Input::get('match_date');
		$player1_id = Input::get('player1_id');
		$player2_id = Input::get('player2_id');
		$p1_score = Input::get('p1_score');
		$p2_score = Input::get('p2_score');
		
		$match_date =  new \DateTime($match_date);
		$match_date = $match_date->format("Y-m-d h:m:s");

		if ((! is_null($player1_id)) && (! is_null($player2_id))) {	
			//create a new match	
			$match = New Match;
		 	$match->player1_id = $player1_id;
          	$match->player2_id = $player2_id;
          	$match->match_date = $match_date;
          	$match->save();

          	//Add match to the current league
			$league_match = New LeagueMatch;	
			$league_match->league_id = $league_id;
          	$league_match->match_id = $match->match_id;
        	$league_match->save();

        	//Create a game and add to the Match
        	if ((! is_null($p1_score)) && (! is_null($p2_score))) {	
        		$game = New Game;	
				$game->score1 = $p1_score;
				$game->score2 = $p2_score;
        		$game->save();

        		$match_game = New MatchGame;	
	          	$match_game->match_id = $match->match_id;
				$match_game->game_id = $game->id;				
				$match_game->game_num = 1; //will be based on league format
	        	$match_game->save();
	        	}
        }

		return \Redirect::route('tools.league.show', array($league_id));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteMatch(Request $request)
	{

		$league_id = Input::get('league_id');
		$match_id = Input::get('match_id');
		      	
    	//Delete match and cascade delete its games
		$match = Match::find($match_id);

		if(!is_null($match)){
			$match->delete();
		}
   
	 	//Delete match from the current league
		$league_match = LeagueMatch::find($league_id)
			->where('match_id', '=', $match_id);			
		$league_match->delete();
     
		return \Redirect::route('tools.league.show', array($league_id));
	}
	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function playerCount($league_id)
	{

		$league = New League;
		$league = $league->find($league_id);
		$players = $league->getPlayers($league_id)
			->get();

		$count = count($players);

		return $count;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($league_id)
	{
		$league = New League;

		$league = $league->find($league_id);

		$players = \DB::table('league_players')
				->where('leage_id', '=', $league_id)
				->orderby('last_name')
				->orderby('first_name');

		//dropdown list
		$players_list = Player::orderby('last_name')->orderby('first_name')->get();
		$players_list = $players_list->lists('last_first_name', 'player_id');
		
		return view('pages/tools.league.edit', compact('league', 'players', 'players_list'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($league_id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($user_id)
	{
		//
	}

}
