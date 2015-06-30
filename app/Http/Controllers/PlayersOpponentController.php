<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Player;
use App\Match;
use App\Http\Requests;
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

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($player,$entry)
	{
		
		return view('pages/players/journal/opponent/create', compact('player', 'entry'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($player, $entry)
	{



		return Redirect::route('opponent.show', [$player->player_id, $entry, $log->id])
		 	->with('flash', 'Opponent Log Saved');
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

	
		$h2h = new Match();
		$head2head = $h2h->head2head($player->player_id, $opponent->player_id);

		return view('pages/players/journal/opponent/show', compact('player', 'entry' ,'opponent', 'opplog', 'head2head'));
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
