<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;
use App\Location;
use App\Scraper;
use App\Tournament;
use App\Player;
use App\Match;

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
		$success='';
		$groups = Group::lists('name','group_id');
		$locations = Location::lists('location','location_id');
		$tournaments = Tournament::orderBy('start_date', 'desc')
			->lists('name','tournament_id');	
		$players = Player::select('first_name', 'last_name', 'player_id',
							\DB::raw('CONCAT(first_name, " ", last_name) as full_name'))
				->orderBy('first_name')
				->orderBy('last_name')
				->get()
				->lists('full_name', 'player_id');
			

		return view('admin.scraper', compact('groups', 'locations','tournaments', 'players', 'success'));
	}

	/**
	 * Download Rankings
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

		return view('pages/rankings', compact('rankings'))
			->with('success', 'rankings downloaded successfully');

	}

	/**
	 * Downlod Tournaments
	 *
	 * @return Response
	 */
	public function tournaments()
	{	

		$ss = new Scraper();

		$new_tournaments = $ss->get_tournaments();
		$tournaments = \DB::table('tournaments')
			->orderBy('start_date', 'desc')
			->get();

		//return view('pages/tournaments', compact('tournaments'));
		return redirect('admin/scraper')
			->with('success', 'tournaments downloaded successfully');
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
					->orderBy('start_date', 'desc')
					->get();

		$participants = \DB::table('participants')
					->where('tournament_id', '=', $tournament_id)
					->get();
		//return view('pages/participants', compact('$tournament', 'participants'));
		return redirect('admin/scraper')
			->with('success', 'participants downloaded successfully');
	}

	/**
	 * Download Player Profile
	 *
	 * @return Response
	 */
	public function player(Request $request)
	{	

		$player_id = $request->input('player_id');
		$ss = new Scraper();

		$ss->get_player($player_id);

		$player = Player::wherePlayer_id($player_id);
		//return view('pages/players.show', compact('player'));
		return redirect('admin/scraper');
	}


	/**
	 * Download Player Matches
	 *
	 * @return Response
	 */
	public function matches(Request $request)
	{	

		$match_player_id = $request->input('player_id');
		$ss = new Scraper();

		$ss->get_matches($match_player_id);

		$match = Match::where('player2_id', '=', $match_player_id)->get();

		return redirect('admin/scraper');
	}
}
