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
			'name'    	=> 'L.A. Fitness @ Midway',
			'address1'  => '4220 Midway',
			'address2'  => '',
			'city'      => 'Carrollton',
			'state'		=> 'TX',
			'zip'       => '75090',
			'map'		=> '',
			'website'   => ''
		]);
		
		GymLocation::create([
			'id' 		=> '2',
			'name'    	=> 'L.A. Fitness @ Coit',
			'address1'  => '1800 George Bush',
			'address2'  => '',
			'city'      => 'Plano',
			'state'		=> 'TX',
			'zip'       => '75900',
			'map'		=> '',
			'website'   => ''
		]);
	}

}
