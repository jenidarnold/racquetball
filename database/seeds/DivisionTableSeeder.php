<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Division;

class DivisionTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('divisions')->delete();


		Division::create([
			'id' => '1',
			'name' => 'Mens Singles: IRT Pro'
		]);
		
		Division::create([
			'id' => '2',
			'name' => 'Mens Singles: Open'
		]);

		Division::create([
			'id' => '3',
			'name' => 'Mens Singles: A'
		]);
		
		Division::create([
			'id' => '4',
			'name' => 'Mens Singles: B'
		]);

		Division::create([
			'id' => '34',
			'name' => 'Womens Singles: LPRT Pro',
		]);

		Division::create([
			'id' => '35',
			'name' => 'Womens Singles: Open'
		]);
	}

}
