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
		return view('admin.home');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function scraper()

	{	
		return view('admin.scraper');
	}

		/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function rankings()

	{	

		$ss = new Scraper();

		$rankings = $ss->get_rankings();

		return view('pages/rankings'); //->with('rankings', $rankings);
		//return Redirect::route('rankings'); //->with('rankings', $rankings);
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function tournaments()

	{	

		$ss = new Scraper();

		$tournaments = $ss->get_tournaments();

		var_dump($tournaments);
		return view('pages/tournaments');
		//return Redirect::route('tournaments');
	}
}
