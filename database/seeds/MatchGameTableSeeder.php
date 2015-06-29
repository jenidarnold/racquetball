<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\MatchGame;

class MatchGameTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('match_games')->delete();


		MatchGame::create([
			'match_id' =>  955,
			'game_id' => 1,
			'game_num' => 1,
		]);
		
		MatchGame::create([
			'match_id' => 955,
			'game_id' => 2,
			'game_num' => 2,
		]);

		MatchGame::create([
			'match_id' =>  972,
			'game_id' => 3,
			'game_num' => 1,
		]);
		
		MatchGame::create([
			'match_id' => 972,
			'game_id' => 4,
			'game_num' => 2,
		]);

		MatchGame::create([
			'match_id' => 970,
			'game_id' => 5,
			'game_num' => 1,
		]);
		
		MatchGame::create([
			'match_id' => 970,
			'game_id' => 6,
			'game_num' => 2,
		]);

		/** Alexandra H. at 2015 Battle Alamo tid: 13654 **/
		/** PRO */
		/** Round 1 */
		MatchGame::create([
			'match_id' => 499,
			'game_id' => 7,
			'game_num' => 1,
		]);
		
		MatchGame::create([
			'match_id' => 499,
			'game_id' => 8,
			'game_num' => 2,
		]);
	
		MatchGame::create([
			'match_id' => 499,
			'game_id' => 9,
			'game_num' => 3,
		]);

		/** Round 2 */
		MatchGame::create([
			'match_id' => 1043,
			'game_id' => 10,
			'game_num' => 1,
		]);

		MatchGame::create([
			'match_id' => 1043,
			'game_id' => 11,
			'game_num' => 2,
		]);
	
		MatchGame::create([
			'match_id' => 1043,
			'game_id' => 12,
			'game_num' => 3,
		]);

		MatchGame::create([
			'match_id' => 1043,
			'game_id' => 13,
			'game_num' => 4,
		]);

		/** Open Round 1 */
		MatchGame::create([
			'match_id' => 1024,
			'game_id' => 14,
			'game_num' => 1,
		]);

		MatchGame::create([
			'match_id' => 1024,
			'game_id' => 15,
			'game_num' => 2,
		]);
	
		/** Open Round 2 */
		MatchGame::create([
			'match_id' => 628,
			'game_id' => 16,
			'game_num' => 1,
		]);

		MatchGame::create([
			'match_id' => 628,
			'game_id' => 17,
			'game_num' => 2,
		]);

		/** Open Round 3 */
		MatchGame::create([
			'match_id' => 308,
			'game_id' => 18,
			'game_num' => 1,
		]);
	
		MatchGame::create([
			'match_id' => 308,
			'game_id' => 19,
			'game_num' => 2,
		]);

		/** Open Round 4 */
		MatchGame::create([
			'match_id' => 1022,
			'game_id' => 20,
			'game_num' => 1,
		]);
	
		MatchGame::create([
			'match_id' => 1022,
			'game_id' => 21,
			'game_num' => 2,
		]);
	}

}
