<?php namespace App\Http\Controllers;

use App\Tournament;
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
		$today = date('Y-m-d');
		$live_tournaments = Tournament::where('start_date', '=', date('Y-m-d'))
							->where('end_date', '<=', date('Y-m-d', strtotime($today.'+2 days')))
							->orderBy('start_date')
							->get();

		$future_tournaments = Tournament::where('start_date', '>', date('Y-m-d'))
						    ->orderBy('start_date')
							->get();

		return view('pages/tournaments.index', compact('live_tournaments', 'future_tournaments'));
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
		return view('pages/tournaments.show', compact('tournament'));
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
