<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\MatchmakerAnswer;

class MatchmakerAnswersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('matchmaker_answers')->delete();
		MatchmakerAnswer::create([
			'id' => 1,
			'question_id' => 1,
			'order_num' => 1,
			'answer' => 'Power Player',
			'value' => 1,
			]);

		MatchmakerAnswer::create([
			'id' => 2,
			'question_id' => 1,
			'order_num' => 2,
			'answer' => 'Balanced Player',
			'value' => 0,
			]);

		MatchmakerAnswer::create([
			'id' => 3,
			'question_id' => 1,
			'order_num' => 3,
			'answer' => 'Control Player',
			'value' => 2,
			]);

		MatchmakerAnswer::create([
			'id' => 4,
			'question_id' => 2,
			'order_num' => 1,
			'answer' => 'Shoot',
			'value' => 1,
			]);

		MatchmakerAnswer::create([
			'id' => 5,
			'question_id' => 2,
			'order_num' => 2,
			'answer' => 'Retrieve',
			'value' => 2,
			]);

		MatchmakerAnswer::create([
			'id' => 6,
			'question_id' => 3,
			'order_num' => 1,
			'answer' => 'Level-headed',
			'value' => 1,
			]);

		MatchmakerAnswer::create([
			'id' => 7,
			'question_id' => 3,
			'order_num' => 2,
			'answer' => 'Emotionally',
			'value' => 2,
			]);
	}
}