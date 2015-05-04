<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Group;

class GroupTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('groups')->delete();


		Group::create([
			'group_id' => '1',
			'name' => 'Mens Singles'
		]);
		
		Group::create([
			'group_id' => '2',
			'name' => 'Womens Singles'
		]);

		Group::create([
			'group_id' => '3',
			'name' => 'Mens Doubles'
		]);
		
		Group::create([
			'group_id' => '4',
			'name' => 'Womens Doubles'
		]);

		Group::create([
			'group_id' => '5',
			'name' => 'Mens Mixed Doubles',
		]);

		Group::create([
			'group_id' => '6',
			'name' => 'Womens Mixed Doubles'
		]);
	}

}
