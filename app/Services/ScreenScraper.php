<?php namespace App\Services;

use App\Scraper;
use App\Ranking;
use App\Tournament;
use App\Participant;
use App\Player;
use App\Match;

class ScreenScraper {

	/**
	 * Insert new Ranking
	 *
	 * @param  array  $data
	 * @return Ranking
	 */

	public function create_ranking(array $data)
	{
		$ranking = \DB::table('rankings')
			->where('ranking_date', '=', $data['ranking_date'])
			->where('group_id', '=', $data['group_id'])
			->where('location_id', '=', $data['location_id'])
			->where('player_id', '=', $data['player_id'])
			->first();

		if (is_null($ranking)) {
			return Ranking::create([
				'ranking_date' => $data['ranking_date'],
				'player_id' => $data['player_id'],
				'ranking' =>  $data['ranking'],
				'group_id' =>  $data['group_id'],
				'location_id' =>  $data['location_id'],
			]);
		}
	}

	/**
	 * Insert new Tournament
	 *
	 * @param  array  $data
	 * @return Tournament
	 */

	public function create_tournament(array $data)
	{

		$tourney = \DB::table('tournaments')
			->where('tournament_id', '=', $data['tournament_id'])
			->first();

		if (is_null($tourney)) {
			return Tournament::create([
				'tournament_id' => $data['tournament_id'],				
				'name' => $data['name'],
				'img_logo' => $data['img_logo'],
				'location' =>  $data['location'],
				'start_date' => $data['start_date'],
				'end_date' => $data['end_date'],
			]);
		}
	}


	/**
	 * Insert new Tournament Participant
	 *
	 * @param  array  $data
	 * @return Participant
	 */

	public function create_participant(array $data)
	{

		$player = \DB::table('participants')
			->where('tournament_id', '=', $data['tournament_id'])
			->where('player_id', '=', $data['player_id'])
			->where('division_id', '=', $data['division_id'])
			->first();

		if (is_null($player)) {
			return Participant::create([
				'tournament_id' => $data['tournament_id'],				
				'player_id' => $data['player_id'],
				'division_id' =>  $data['division_id'],
			]);
		}
	}

	/**
	 * Insert new Player
	 *
	 * @param  array  $data
	 * @return Participant
	 */

	public function create_player(array $data)
	{

		$player = \DB::table('players')
			->where('player_id', '=', $data['player_id'])
			->first();

		if (is_null($player)) {
			return Player::create([
				'player_id' => $data['player_id'],
				'first_name' =>  $data['first_name'],
				'last_name' =>  $data['last_name'],
				'gender' =>  $data['gender'],
				'home' =>  $data['home'],
				'skill_level' =>  $data['skill_level'],
				'img_profile' =>  $data['img_profile'],
			]);
		}
	}

	/**
	 * Insert new Match
	 *
	 * @param  array  $data
	 * @return Participant
	 */

	public function create_match(array $data)
	{
	
		$players = Player::select('player_id', 'first_name', 'last_name', \DB::raw('CONCAT(first_name, " ", last_name) as full_name'))
					->lists('player_id','full_name');
			
		//check to see if players exist in Players table
		$err = '';
		if (!array_key_exists($data['player1'], $players))
		{
			$err .= '  Not in Players table: ' . $data['player1'];
		}
		if (!array_key_exists($data['player2'], $players))
		{
			$err .= '  Not in Players table: ' . $data['player2'];
		}

		if ($err == '') {
			$player1_id = $players[$data['player1']];
			$player2_id = $players[$data['player2']];

			$match = \DB::table('matches')
				->where('tournament_id', '=', $data['tournament_id'])
				->where('player1_id', '=', $player1_id ) 
				->where('player2_id', '=', $player2_id )
				//->orWhere('player1_id' => $player2_id, 'player2_id' => $player1_id )
				->first();

			if (is_null($match)) {
				$match = Match::create([
					'player1_id' => $player1_id,
					'player2_id' => $player2_id,
					'winner_id' =>  $player1_id,
					'tournament_id' =>  $data['tournament_id'],
					'match_date' =>  $data['match_date'],
					'match_type' =>  $data['match_type'],
					'match_division' =>  $data['match_division'],
				]);
			}	
		}	
	}

}
