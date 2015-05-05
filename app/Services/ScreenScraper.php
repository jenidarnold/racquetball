<?php namespace App\Services;

use App\Scraper;
use App\Ranking;
use App\Tournament;
use App\Participant;
use App\Player;

class ScreenScraper {

	/**
	 * Insert new Ranking
	 *
	 * @param  array  $data
	 * @return Ranking
	 */

	public function create_ranking(array $data)
	{

			return Ranking::create([
				'ranking_date' => $data['ranking_date'],
				'player_id' => $data['player_id'],
				'ranking' =>  $data['ranking'],
			]);

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

		return Participant::create([
			'tournament_id' => $data['tournament_id'],				
			'player_id' => $data['player_id'],
			'division_id' =>  $data['division_id'],
		]);

	}

	/**
	 * Insert new Player
	 *
	 * @param  array  $data
	 * @return Participant
	 */

	public function create_player(array $data)
	{

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
