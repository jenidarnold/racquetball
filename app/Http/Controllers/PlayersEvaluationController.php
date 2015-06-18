<?php namespace App\Http\Controllers;

use App\Player;
use App\Match;
use App\EvaluationCategory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PlayersEvaluationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($player)
	{

		return view('pages/players/journal/evaluation/index', compact('player'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($player)
	{
		$categories = EvaluationCategory::all();

		return view('pages/players/journal/evaluation/create', compact('player', 'categories'));
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
		
		return view('pages/players/journal/evaluation/show', compact('player'));
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
