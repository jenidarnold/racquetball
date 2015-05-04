<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Location;

class LocationTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('locations')->delete();


		Location::create([
			'location_id' => '0',
			'location'    => 'National',
			'abbrev'      => 'Nat',
		]);
		
		Location::create([
			'location_id' => '1',
			'location'    => 'Texas',
			'abbrev'      => 'TX',
		]);

		Location::create([
			'location_id' => '2',
			'location'    => 'Alabama',
			'abbrev'      => 'AL',
		]);
		
		Location::create([
			'location_id' => '3',
			'location'    => 'Alaska',
			'abbrev'      => 'AK'
		]);		
	}

}
