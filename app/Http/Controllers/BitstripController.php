<?php namespace App\Http\Controllers;

use App\Player;
use App\MatchGame;
use App\Match;
use App\Game;
use App\Tournament;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BitstripController extends Controller {

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
		//$bitstrips = \DB::table('bitstrips')
		//		->orderby('title')
		//		->orderby('created_on');
	

		//Grid Paging
		//$bitstrips = $bitstrips->paginate(5);

		return view('pages/bitstrips/index', compact('bitstrips'));
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
	public function show($bitstrip)
	{
		
		return view('pages/bitstrips/show', compact('bitstrip'));
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
