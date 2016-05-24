<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\League;

class LeagueTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('leagues')->delete();

		League::create([
			'league_id' => '1',
			'name' => 'Winter 2015 Monday A/B League',			
			'start_date' => '2015-10-01',
			'end_date' => '2016-02-18',
			'url' => '???',
			'format_id' => 1,
			'location_id' => 1
		]);
		
		League::create([
			'league_id' => '2',
			'name' => 'Winter 2015 Wednesday C/D League',			
			'start_date' => '2015-10-01',
			'end_date' => '2016-02-18',
			'url' => '???',
			'format_id' => 1,
			'location_id' => 1
		]);

		League::create([
			'league_id' => '3',
			'name' => 'Spring 2016 Monday A/B League',			
			'start_date' => '2016-01-15',
			'end_date' => '2016-03-20',
			'url' => '???',
			'format_id' => 1,
			'location_id' => 1
		]);
		
		League::create([
			'league_id' => '4',
			'name' => 'Spring 2016 Wednesday C/D League',			
			'start_date' => '2016-01-15',
			'end_date' => '2016-03-20',
			'url' => '???',
			'format_id' => 1,
			'location_id' => 1
		]);
	
	}

}
