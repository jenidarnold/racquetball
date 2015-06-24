<?php namespace App\Http\Controllers;

use App\Tournament;
use App\Participant;
use App\Scraper;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ParticipantsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Tournament $tournament)
	{		

		//dd($tournament->participants);
		//$participants = $tournament->participants;

		// Paginate
		//$perPage = 10; // Item per page (change if needed)
		//$currentPage = Input::get('page') - 1;
		//$pagedData = $participants->slice($currentPage * $perPage, $perPage)->all();
		//$participants= Paginator::make($pagedData, count($participants), $perPage);

		//return view('pages.participants.index', compact('tournament', 'participants'));
		return view('pages.participants.index', compact('tournament'));
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
	public function show(Tournament $tournament, Participant $participant) //$tournament_id, $division_id)
	{					
		return view('pages.participants.show', compact('tournament', 'participant'));
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
