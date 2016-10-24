<?php namespace App\Http\Controllers\Tools;

use Input;
use App\Http\Requests;
use App\Tournament;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JavaScript;

class RefereeController extends Controller {

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
	 *  Display decsription of Referee App
	 *
	 * @return Response
	 */
	public function index()
	{		
		return view('pages/tools.referee.index');
	}

	/**
	 *  Display decsription of Referee App
	 *
	 * @return Response
	 */
	public function about()
	{		
		return view('pages/tools.referee.index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function match()
	{
		$tournaments = Tournament::selectRaw('CONCAT(name, " (", start_date, ")") as name, tournament_id')
			->orderBy('start_date', 'desc')
			->lists('name','tournament_id');
		
		JavaScript::put([
        	'tournaments' => $tournaments 
 		]);

		return view('pages/tools.referee.match', compact('tournaments'));
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function show($user_id)
	{
		
		return view('pages/tools.referee.user.show');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		return view('pages/tools.referee.show');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function live()
	{
		
		return view('pages/tools.referee.live');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function completed()
	{
		
		return view('pages/tools.referee.completed');
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($user_id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($user_id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($user_id)
	{
		//
	}

}
