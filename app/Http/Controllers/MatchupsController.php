<?php namespace App\Http\Controllers;

use Input;
use App\Skill;
use App\Vote;
use App\Ranking;
use App\Player;
use App\Match;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MatchupsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	
		$players = Player::orderby('last_name')->orderby('first_name')->get();
		$players_list = $players->lists('last_first_name', 'player_id');
		
		$player1 = (object)	['player_id' => '-1'];
		$player2 = (object)	['player_id' => '-1'];

		return view('pages/matchups.index', compact('players_list', 'player1', 'player2'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request)
	{
		
		$player1ID = Input::get('ddlPlayer1');
		$player2ID = Input::get('ddlPlayer2');

		$players_list = Player::orderby('last_name')
			->orderby('first_name')
			->get()
			->lists('last_first_name', 'player_id');

		$player1 = Player::where('player_id', '=', $player1ID)->first();
		$player2 = Player::where('player_id', '=', $player2ID)->first();
	
		$h2h = new Match();

		$head2head = $h2h->head2head($player1ID, $player2ID);
		$skills = Skill::orderby('skill_id')
			->get();

		$votes = new Vote();
		$voter_id = \Auth::user()->id;



		return view('pages/matchups.show', compact('players_list', 'player1', 'player2', 'head2head', 'skills', 'votes', 'voter_id'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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

}
