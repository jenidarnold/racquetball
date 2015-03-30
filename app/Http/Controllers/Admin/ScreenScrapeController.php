<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Scraper;

class ScreenScrapeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Screen Scrape Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling screen scrape requests
	|
	*/

	/**
	 * Create a new screen scrape controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()

	{	

		$ss = new Scraper();

		//$events = $ss->get_events();
		$rankings = $ss->get_rankings();
		//$player = $ss->get_player(8220);
		//$participants = $ss->get_participants(13654);

		return view('pages/rankings')->with('rankings', $rankings);
		//return View::make('pages/rankings')->with('rankings', $rankings);
		//return Redirect::route('pages/rankings')->with('rankings', $rankings);
	}
}
