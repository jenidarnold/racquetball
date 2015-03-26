<?php namespace App\Services;

use App\Scraper;

class ScreenScraper {

	/**
	 * Insert new Rankings
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create_ranking(array $data)
	{
		return Ranking::create([
			'ranking_date' => $data['ranking_date'],
			'player_id' => $data['player_id'],
			'ranking' => ($data['ranking']),
		]);
	}
}
