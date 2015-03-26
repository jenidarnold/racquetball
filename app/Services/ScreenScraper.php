<?php namespace App\Services;

use App\Scraper;

class ScreenScraper {

	/**
	 * Get ScreenScrapes
	 *
	 * @param  none
	 * @return array Players
	 */
	public function get_players()
	{
		$ss = new Scraper;

		return $ss->get_players();
	}
}
