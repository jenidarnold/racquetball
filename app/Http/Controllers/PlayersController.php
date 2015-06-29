<?php namespace App\Http\Controllers;

use App\Player;
use App\MatchGame;
use App\Match;
use App\Game;
use App\Tournament;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PlayersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

		$level = $request->input('level');
		$gender = $request->input('gender');
		$firstname = $request->input('first_name');
		$lastname = $request->input('last_name');

		$players = \DB::table('players')
				->orderby('last_name')
				->orderby('first_name');

		if (isset($gender)) {
			if ($gender != 'All') {
				$players = $players->where('gender', '=', $gender);
			}
		}

		if (isset($level)) {
			if ($level != 'All') {
				$players = $players->where('skill_level', '=', $level);
			}
		}

		if (isset($firstname)) {
			if ($firstname != '') {
				$players = $players->where('first_name',  'like', "%$firstname%");
			}
		}

		if (isset($lastname)) {
			if ($lastname != '') {
				$players = $players->where('last_name', 'like', "%$lastname%");		
			}	
		}

		$players = $players->paginate(5);


		return view('pages/players/index', compact('players', 'level', 'gender'));
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
	public function show($player)
	{
		
		return view('pages/players/bio', compact('player'));
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

	/**
	 * Player Tournament History
	 */
	public function getTournaments($player){
	
		$matches = $player->getMatches();
		$tournaments = $player->getTournaments();


		//used to get Scores
		$tournament = New Tournament();
		$match = New MatchGame();
		$game = New Game();

		//return view('pages/players/show', compact('player', 'matches', 'tournaments'));
		return view('pages/players/tournaments', compact('player', 'matches', 'tournaments', 'tournament', 'match', 'game'));
	}

		/**
	 * Player Tournament History
	 */
	public function getBio($player){
	
		return view('pages/players/bio', compact('player'));
	}
}
