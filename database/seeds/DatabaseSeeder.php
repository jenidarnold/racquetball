<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('DivisionTableSeeder');
		$this->command->info('Division table seeded!');

		$this->call('EvaluationCategoryTableSeeder');
		$this->command->info('EvaluationCategory table seeded!');

		$this->call('EvaluationSubCategoryTableSeeder');
		$this->command->info('EvaluationSubCategory table seeded!');

		$this->call('GameTableSeeder');
		$this->command->info('Game table seeded!');

		$this->call('GroupTableSeeder');
		$this->command->info('Group table seeded!');
		
		$this->call('LocationTableSeeder');
        $this->command->info('Location table seeded!');

		$this->call('MatchGameTableSeeder');
		$this->command->info('MatchGame table seeded!');

		$this->call('SkillTableSeeder');
		$this->command->info('Skill table seeded!');

		$this->call('TournamentDivisionTableSeeder');
		$this->command->info('TournamentDivision table seeded!');

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

		$this->call('VoteTableSeeder');
		$this->command->info('Vote table seeded!');
	}

}
