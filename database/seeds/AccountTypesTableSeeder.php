<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\AccountType;

class AccountTypesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('account_types')->delete();

		AccountType::create([
			'type_id' => '1',
			'app_name' => 'RacquetballHub'
		]);
		
		AccountType::create([
			'type_id' => '2',
			'app_name' => 'Facebook'
		]);

		AccountType::create([
			'type_id' => '3',
			'app_name' => 'Google+'
		]);

		AccountType::create([
			'type_id' => '4',
			'app_name' => 'InstaGram'
		]);

		AccountType::create([
			'type_id' => '5',
			'app_name' => 'Twitter'
		]);
	
	}

}
