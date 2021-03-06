<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\MatchmakerPlayerAnswer;

class MatchmakerPlayerAnswersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('matchmaker_player_answers')->delete();
		MatchmakerPlayerAnswer::create([
			'player_id' => 192412,
			'question_id' => 1,
			'answer_id' => 1,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 192412,
			'question_id' => 2,
			'answer_id' => 5,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 192412,
			'question_id' => 3,
			'answer_id' => 6,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 17446,
			'question_id' => 1,
			'answer_id' => 1,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 17446,
			'question_id' => 2,
			'answer_id' => 4,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 17446,
			'question_id' => 3,
			'answer_id' => 7,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 14129,
			'question_id' => 1,
			'answer_id' => 2,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 14129,
			'question_id' => 2,
			'answer_id' => 5,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 14129,
			'question_id' => 3,
			'answer_id' => 7,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 198178,
			'question_id' => 1,
			'answer_id' => 3,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 198178,
			'question_id' => 2,
			'answer_id' => 2,
			]);

		MatchmakerPlayerAnswer::create([
			'player_id' => 198178,
			'question_id' => 3,
			'answer_id' => 6,
			]);
	}
}