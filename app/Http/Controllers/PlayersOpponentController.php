<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Player;
use App\Match;
use App\Http\Requests;
use App\PlayerEvaluation;
use App\EvaluationScore;
use App\EvaluationCategory;
use App\Http\Controllers\Controller;
//use App\Opponent;
use Illuminate\Http\Request;

class PlayersOpponentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($player, $entry)
	{

		$opplogs = (object) array();
		$opponents = Player::orderBy('full_name');

		return view('pages/players/journal/opponent/index', compact('player', 'entry', 'opponents', 'opplogs'));
	}

	public function listEvaluations($player, $opponent, $entry)
	{

		$evaluations = PlayerEvaluation::where('player_id', '=', $opponent->player_id)
			->where('creator_id', '=', $player->player_id)
			->orderBy('created_at', 'desc')
			->paginate(10);

		return view('pages/players/journal/opponent/evaluation/index', compact('player', 'entry', 'evaluations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($player,$entry)
	{		
		$target_id = -1;
		$players = Player::orderby('last_name')->orderby('first_name')->get();
		$players_list = $players->lists('last_first_name', 'player_id');

		return view('pages/players/journal/opponent/create', compact('player', 'target_id', 'categories', 'entry', 'players_list'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createEvaluation($player,$entry, $opponent_id)
	{

		$categories = EvaluationCategory::all();		
		$opponent = Player::find($opponent_id);
		return view('pages/players/journal/opponent/evaluate', compact('player', 'opponent', 'categories', 'entry'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($player, $entry)
	{

		$input = Input::all();

		
		// 1. Create a new Player Evaluation Form	
		$opp = Opponent::create(['player_id' => $player->player_id, 'title' => $input["eval_title:"]]);

		// 2. Loop through input and save
		foreach ($categories as $c) {
		 	foreach ($c->subcategories as $s) {
		 		$score = $input["score-$c->category_id-$s->subcategory_id"];
		 		$comment =  $input["comment-$c->category_id-$s->subcategory_id"];

				$eval_score = EvaluationScore::create(['evaluation_id' => $eval->evaluation_id, 
					'category_id' => $c->category_id, 
					'subcategory_id' => $s->subcategory_id, 
					'score' => $score, 
					'comment' => $comment,
					]);
			}
		}
	

		return Redirect::route('opponent.show', [$player->player_id, $entry, $log->id])
		 	->with('flash', 'Opponent Entry Saved');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($player, $entry, $opponent_id)
	{

		$opponent = Player::find($opponent_id);
		$opplog = []; // OpponentLog::where('opponent_id' , '=', $opponent_id);

		//Match History	
		$h2h = new Match();
		$head2head = $h2h->head2head($player->player_id, $opponent->player_id);

		//Evaluation
		$evaluation_id = 28; // get opponent evalution_id by table PlayerID -> entry_ID -> Opponent_id
		$categories = EvaluationCategory::all();
		$evaluation = PlayerEvaluation::find($evaluation_id);
		$scores =EvaluationScore::where('evaluation_id' , '=', $evaluation_id);
	
		//Notes
		//
		//
		//
		return view('pages/players/journal/opponent/show', 
			compact('player', 'entry' ,'opponent', 'opplog', 'head2head', 'evaluation', 'categories', 'scores'));
	}



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($player, $entry, $opponent)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($player, $entry, $opponent)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Player Tournament History
	 */
	public function getTournaments($player){
	
		$matches = $player->getMatches();
		$tournaments = $player->getTournaments();

		//return view('pages/players/show', compact('player', 'matches', 'tournaments'));
		return view('pages/players/tournaments', compact('player', 'matches', 'tournaments'));
	}

	/**
	 * Player Tournament History
	 */
	public function getBio($player){
	
		return view('pages/players/bio', compact('player'));
	}
}
