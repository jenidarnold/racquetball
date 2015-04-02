<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\TournamentDivision;

class TournamentDivisionTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('tournament_division')->delete();

		TournamentDivision::create([
			'tournament_id' => '13654',
			'division_id' => '1'
		]);
		

		TournamentDivision::create([
			'tournament_id' => '13654',
			'division_id' => '2'
		]);
		

		TournamentDivision::create([
			'tournament_id' => '13654',
			'division_id' => '3'
		]);
		

		TournamentDivision::create([
			'tournament_id' => '13654',
			'division_id' => '4'
		]);
		
		TournamentDivision::create([
			'tournament_id' => '13654',
			'division_id' => '34'
		]);
		

		TournamentDivision::create([
			'tournament_id' => '13654',
			'division_id' => '35'
		]);
		

		TournamentDivision::create([
			'tournament_id' => '13556',
			'division_id' => '1'
		]);
		

		TournamentDivision::create([
			'tournament_id' => '13556',
			'division_id' => '2'
		]);
		

	}

}
