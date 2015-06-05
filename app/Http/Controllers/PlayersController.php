<?php namespace App\Http\Controllers;

use App\Player;
use App\Match;
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

		$players = $players->get();


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
		//$players = Player::all();
		$matches = Match::where("player1_id", '=', $player->player_id)
						->orWhere("player2_id", '=', $player->player_id)
						->get();

		$tournaments = $player->getTournaments();

		return view('pages/players/show', compact('player', 'matches', 'tournaments'));
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
