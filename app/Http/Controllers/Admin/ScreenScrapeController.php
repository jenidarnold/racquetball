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


		var_dump($ss->get_players());
		//return view('admin/scraper');
	}
}
