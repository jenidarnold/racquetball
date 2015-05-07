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
	public function rankings(Request $request)

	{	

		$group_id = $request->input('group_id');
		$location_id = $request->input('location_id');
		$maxRank = 300;

		$ss = new Scraper();

		$new_rankings = $ss->get_rankings($group_id, $location_id, $maxRank);

        $rankings = \DB::table('rankings')
				->leftJoin('players', 'rankings.player_id', '=', 'players.player_id')
				->leftJoin('groups', 'rankings.group_id', '=', 'groups.group_id')
				->leftJoin('locations', 'rankings.location_id', '=', 'locations.location_id')
				->where('rankings.group_id', '=', $group_id)
				->where('rankings.location_id', '=', $location_id)
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

		$new_tournaments = $ss->get_tournaments();
		$tournaments = \DB::table('tournaments')
					->get();

		return view('pages/tournaments', compact('tournaments'));
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

		$new_participants = $ss->get_participants($tournament_id);


		$tournament = \DB::table('tournaments')
					->where('tournament_id', '=', $tournament_id)
					->get();

		$participants = \DB::table('participants')
					->where('tournament_id', '=', $tournament_id)
					->get();
		return view('pages/participants', compact('$tournament', 'participants'));
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
