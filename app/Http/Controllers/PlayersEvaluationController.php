<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Player;
use App\PlayerEvaluation;
use App\EvaluationScore;
use App\Match;
use App\EvaluationCategory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PlayersEvaluationController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->user = \Auth::user();
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($player, $entry, $target_id)
	{
	
		$self_evals = PlayerEvaluation::where('player_id', '=', $target_id)
			->where('creator_id', '=', $player->player_id)
			->orderBy('created_at', 'desc')
			->paginate(5);

		$peer_evals = PlayerEvaluation::where('player_id', '=', $target_id)
			->where('creator_id', '!=', $player->player_id)
			->orderBy('created_at', 'desc')
			->paginate(5);

		$opp_evals = PlayerEvaluation::where('player_id', '!=', $target_id)
			->where('creator_id', '=', $player->player_id)
			->orderBy('created_at', 'desc')
			->paginate(5);

		return view('pages/players/journal/evaluation/index', compact('player', 'target', 'entry', 'self_evals', 'peer_evals', 'opp_evals'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($player,$entry)
	{
		$categories = EvaluationCategory::all();
		
		return view('pages/players/journal/evaluation/create', compact('player', 'categories', 'entry'));
	}


	/**
	 * Show the form for inviting a new resource.
	 *
	 * @return Response
	 */
	public function invite($player)
	{
		//TODO get rid of entry variable
		$entry = 1;

		$players = Player::orderby('last_name')->orderby('first_name')->get();
		$players_list = $players->lists('last_first_name', 'player_id');
				
		return view('pages/players/journal/evaluation/invite', compact('player', 'players_list','entry'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($player, $entry)
	{
		$categories = EvaluationCategory::all();
		$input = Input::all();

		$scores = [];
		
		// 1. Create a new Player Evaluation Form	
		$eval = PlayerEvaluation::create(['player_id' => $player->player_id, 'title' => $input["eval_title:"]]);

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
	
		return Redirect::route('evaluation.show', [$player->player_id, $entry, $eval->id])
		 	->with('flash', 'Evaluation Saved');
		// 	->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($player, $entry, $target, $creator, $evaluation_id)
	{

		$evaluation = PlayerEvaluation::find($evaluation_id);
		$categories = EvaluationCategory::all();		
		$scores =EvaluationScore::where('evaluation_id' , '=', $evaluation_id);

		return view('pages/players/journal/evaluation/show', compact('categories', 'player', 'entry' ,'evaluation', 'scores'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($player, $entry, $target, $creator, $evaluation_id)
	{
		
		$evaluation = PlayerEvaluation::find($evaluation_id);
		$categories = EvaluationCategory::all();
		$scores =EvaluationScore::where('evaluation_id' , '=', $evaluation_id);

		return view('pages/players/journal/evaluation/edit', compact('categories', 'player', 'entry' ,'evaluation', 'scores'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($player, $entry, $evaluation)
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
	public function getTournaments($player)
	{
	
		$matches = $player->getMatches();
		$tournaments = $player->getTournaments();
		return view('pages/players/tournaments', compact('player', 'matches', 'tournaments'));
	}

	/**
	 * Player Tournament History
	 */
	public function getBio($player)
	{	
		return view('pages/players/bio', compact('player'));
	}
}
