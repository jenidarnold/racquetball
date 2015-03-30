<?php namespace App\Http\Controllers;

use App\Ranking;

class PagesController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Pages Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's pages
	*/


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function rankings()
	{

		$rankings = rankings::all();
		return view('pages/rankings', $rankings);
	}

}
