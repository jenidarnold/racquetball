<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\AccountLink;

class AccountLinksTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('account_links')->delete();

		AccountLink::create([
			'user_id' => 17,
			'app_type_id' => '2',
			'app_user_id' => '10202089799524680'
		]);
				
	}

}
