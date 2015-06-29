<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Game;

class GameTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('games')->delete();


		Game::create([
			'id' =>  1,
			'score1' => 15,
			'score2' => 0,
			'minutes' => 10
		]);
		
		Game::create([
			'id' => 2,
			'score1' => 15,
			'score2' => 14,
			'minutes' => 27
		]);


		Game::create([
			'id' =>  3,
			'score1' => 15,
			'score2' => 4,
			'minutes' => 20
		]);
		
		Game::create([
			'id' => 4,
			'score1' => 15,
			'score2' => 4,
			'minutes' => 22
		]);

		Game::create([
			'id' =>  5,
			'score1' => 15,
			'score2' => 10,
			'minutes' => 33
		]);
		
		Game::create([
			'id' => 6,
			'score1' => 15,
			'score2' => 7,
			'minutes' => 28
		]);

		/** Alexandra H. Battle Alamo */
		/** Pro Rnd 1*/
		Game::create([
			'id' => 7,
			'score1' => 11,
			'score2' => 7,
			'minutes' => 28
		]);

		Game::create([
			'id' => 8,
			'score1' => 11,
			'score2' => 8,
			'minutes' => 28
		]);

		Game::create([
			'id' => 9,
			'score1' => 11,
			'score2' => 8,
			'minutes' => 28
		]);

		/** Pro Rnd 2*/
		Game::create([
			'id' => 10,
			'score1' => 11,
			'score2' => 9,
			'minutes' => 28
		]);

		Game::create([
			'id' => 11,
			'score1' => 11,
			'score2' => 7,
			'minutes' => 28
		]);

		Game::create([
			'id' => 12,
			'score1' => 2,
			'score2' => 11,
			'minutes' => 28
		]);

		Game::create([
			'id' => 13,
			'score1' => 15,
			'score2' => 13,
			'minutes' => 28
		]);

		/** Open Rnd 1 */
		Game::create([
			'id' => 14,
			'score1' => 15,
			'score2' => 1,
			'minutes' => 10
		]);

		Game::create([
			'id' => 15,
			'score1' => 15,
			'score2' => 0,
			'minutes' => 8
		]);

		/** Open Rnd 2 */
		Game::create([
			'id' => 16,
			'score1' => 15,
			'score2' => 3,
			'minutes' => 19
		]);

		Game::create([
			'id' => 17,
			'score1' => 15,
			'score2' => 1,
			'minutes' => 14
		]);

		/** Open Rnd 3 */
		Game::create([
			'id' => 18,
			'score1' => 15,
			'score2' => 4,
			'minutes' => 22
		]);

		Game::create([
			'id' => 19,
			'score1' => 15,
			'score2' => 2,
			'minutes' => 17
		]);

		/** Open Rnd 4 */
		Game::create([
			'id' => 20,
			'score1' => 15,
			'score2' => 13,
			'minutes' => 36
		]);

		Game::create([
			'id' => 21,
			'score1' => 15,
			'score2' => 11,
			'minutes' => 32
		]);
	}

}
