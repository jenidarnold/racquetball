<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Skill;

class SkillTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('skills')->delete();

		Skill::create([
			'skill_id' => '1',
			'skill'	=> 'Power',
		]);
		
		Skill::create([
			'skill_id' => '2',
			'skill'	=> 'Control',
		]);

		Skill::create([
			'skill_id' => '3',
			'skill'	=> 'Speed',
		]);

		Skill::create([
			'skill_id' => '4',
			'skill'	=> 'Serves',
		]);

		Skill::create([
			'skill_id' => '5',
			'skill'	=> 'Returns',
		]);

		Skill::create([
			'skill_id' => '6',
			'skill'	=> 'Forehand',
		]);

		Skill::create([
			'skill_id' => '7',
			'skill'	=> 'Backhand',
		]);

		Skill::create([
			'skill_id' => '8',
			'skill'	=> 'Fitness',
		]);

		Skill::create([
			'skill_id' => '9',
			'skill'	=> 'Mental',
		]);

		Skill::create([
			'skill_id' => '10',
			'skill'	=> 'Versatility',
		]);
	}

}
