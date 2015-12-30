<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\MatchmakerQuestion;

class MatchmakerQuestionsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('matchmaker_questions')->delete();
		MatchmakerQuestion::create([
			'id' => 1,
			'category_id' => 1,
			'order_num' => 1,
			'question' => 'Are you a Power player, Control Player, or Balanced Player?',
			]);

		MatchmakerQuestion::create([
			'id' => 2,
			'category_id' => 1,
			'order_num' => 2,
			'question' => 'Do you prefer to Shoot or Retrieve the ball?',
			]);

		MatchmakerQuestion::create([
			'id' => 3,
			'category_id' => 1,
			'order_num' => 3,
			'question' => 'Do you prefer to Shoot or Retrieve the ball?',
			]);
	}
}