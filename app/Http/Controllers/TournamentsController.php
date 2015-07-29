<?php namespace App\Http\Controllers;

use App\Scraper;
use App\Tournament;
use App\Participant;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TournamentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$s = New Scraper();
		$tournaments = $s->get_tournaments();


		$today = date('Y-m-d');
		$past_tournaments = Tournament::where('end_date', '<', date('Y-m-d'))
							->orderBy('start_date', 'desc')							
							->paginate(5);							

		$live_tournaments = Tournament::where('start_date', '<=', date('Y-m-d'))
							->where('end_date', '>=', date('Y-m-d'))
							->orderBy('start_date')
							->paginate(5);

		$future_tournaments = Tournament::where('start_date', '>', date('Y-m-d'))
						    ->orderBy('start_date')							
							->paginate(5);

		return view('pages/tournaments.index', compact('past_tournaments','live_tournaments', 'future_tournaments'));
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
	 * @param  Tournament  $tournament
	 * @return Response
	 */
	public function show($tournament)
	{		
		// Loop thru participants and download profile before pass to view		 
		$s = New Scraper();
		$participants = $tournament->participants;

		var_dump($participants);
		//Removed because: This needs to be evaluated for speed and overwhelming the original site
		//$updated = false;
		//foreach ($participants as $participant){
		//	if ($participant->player["full_name"] == "") {							
		//	$s->get_player($participant->player_id);
		//		$s->get_matches($participant->player_id);				
		//		$updated = true;
		//	}
		//}

		//if ($updated){
		//	$participants = Participant::where("tournament_id", "=", $tournament->tournament_id);
		//}

		return view('pages/tournaments.show', compact('tournament', 'participants'));
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
