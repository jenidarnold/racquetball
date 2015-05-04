<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;
use App\Location;
use App\Scraper;
use App\Tournament;
use App\Player;

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

		$groups = group::lists('name','group_id');
		$locations = location::lists('location','location_id');
		$tournaments = tournament::lists('name','tournament_id');
		return view('admin.scraper', compact('groups', 'locations','tournaments'));
	}

		/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function rankings()

	{	

		$ss = new Scraper();

		$new_rankings = $ss->get_rankings();

        $rankings = \DB::table('rankings')
				->leftJoin('players', 'rankings.player_id', '=', 'players.player_id')
				->get();

		return view('pages/rankings', compact('rankings'));

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

		return view('pages/tournaments');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function participants(Request $request)

	{	

		$tournament_id = $request->input('tournament_id');
		$ss = new Scraper();

		$participants = $ss->get_participants($tournament_id);
		return view('pages/participants');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function player(Request $request)

	{	

		$player_id = $request->input('player_id');
		$ss = new Scraper();

		$ss->get_player($player_id);

		$player = Player::wherePlayer_id($player_id);
		return view('pages/players.show', compact('player'));
	}
}
