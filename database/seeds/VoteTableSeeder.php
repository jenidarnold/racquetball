<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Vote;

class VoteTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('votes')->delete();
		//Voter 1
		Vote::create([
			'vote_id' => '1',
			'voter_id' => '1',
			'skill_id' => '1',
			'for_id' => '192412',
			'against_id' => '17446',
		]);
		
		Vote::create([
			'vote_id' => '2',
			'voter_id' => '1',
			'skill_id' => '2',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '3',
			'voter_id' => '1',
			'skill_id' => '3',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '4',
			'voter_id' => '1',
			'skill_id' => '4',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '5',
			'voter_id' => '1',
			'skill_id' => '5',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '6',
			'voter_id' => '1',
			'skill_id' => '6',
			'for_id' => '192412',
			'against_id' => '17446',
		]);

		Vote::create([
			'vote_id' => '7',
			'voter_id' => '1',
			'skill_id' => '7',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '8',
			'voter_id' => '1',
			'skill_id' => '8',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '9',
			'voter_id' => '1',
			'skill_id' => '9',
			'for_id' => '192412',
			'against_id' => '17446',
		]);

		Vote::create([
			'vote_id' => '10',
			'voter_id' => '1',
			'skill_id' => '10',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		//Voter 2
		Vote::create([
			'vote_id' => '11',
			'voter_id' => '1',
			'skill_id' => '1',
			'for_id' => '192412',
			'against_id' => '17446',
		]);
		
		Vote::create([
			'vote_id' => '12',
			'voter_id' => '2',
			'skill_id' => '2',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '13',
			'voter_id' => '2',
			'skill_id' => '3',
			'for_id' => '192412',
			'against_id' => '17446',
		]);

		Vote::create([
			'vote_id' => '14',
			'voter_id' => '2',
			'skill_id' => '4',
			'for_id' => '192412',
			'against_id' => '17446',
		]);

		Vote::create([
			'vote_id' => '15',
			'voter_id' => '2',
			'skill_id' => '5',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '16',
			'voter_id' => '2',
			'skill_id' => '6',
			'for_id' => '192412',
			'against_id' => '17446',
		]);

		Vote::create([
			'vote_id' => '17',
			'voter_id' => '2',
			'skill_id' => '7',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '18',
			'voter_id' => '2',
			'skill_id' => '8',
			'for_id' => '17446',
			'against_id' => '192412',
		]);

		Vote::create([
			'vote_id' => '19',
			'voter_id' => '2',
			'skill_id' => '9',
			'for_id' => '192412',
			'against_id' => '17446',
		]);

		Vote::create([
			'vote_id' => '20',
			'voter_id' => '2',
			'skill_id' => '10',
			'for_id' => '192412',
			'against_id' => '17446',
		]);
	}

}
