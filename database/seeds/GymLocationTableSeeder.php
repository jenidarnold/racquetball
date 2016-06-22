<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\GymLocation;

class GymLocationTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('gym_locations')->delete();


		GymLocation::create([
			'id' 		=> '1',
			'name'    	=> 'L.A. Fitness Carrollton',
			'address1'  => '4220 Midway Rd',
			'address2'  => '',
			'city'      => 'Carrollton',
			'state'		=> 'TX',
			'zip'       => '75007',
			'map'		=> '',
			'website'   => ''
		]);
		
		GymLocation::create([
			'id' 		=> '2',
			'name'    	=> 'L.A. Fitness Plano South @ W Pres GWB Hwy',
			'address1'  => '3701 W. Pres. George Bush Hwy',
			'address2'  => '',
			'city'      => 'Plano',
			'state'		=> 'TX',
			'zip'       => '75075',
			'map'		=> '',
			'website'   => ''
		]);

		GymLocation::create([
			'id' 		=> '3',
			'name'    	=> 'L.A. Dallas LBJ @ Webb Chapel',
			'address1'  => '3029 Forest Lane',
			'address2'  => '',
			'city'      => 'Dallas',
			'state'		=> 'TX',
			'zip'       => '75234',
			'map'		=> '',
			'website'   => ''
		]);
	}	
}
