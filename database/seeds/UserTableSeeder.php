<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
		//Userr 1 Julie vs Bernie
		User::create([
			'id' => '1',
			'name' => 'Julienne Arnold',
			'email' => 'julie.enid@gmail.com',
			'password' => '$2y$10$tfD9BXYwPTfsxD/yzLoGOe7VdgXwWin0kUWQLNwiZZ.si6aHsL5UW',
			'player_id' => '192412',
			'enabled' => 'true',
		]);
		
		User::create([
			'id' => '2',
			'name' => 'Bernadette Zimmerman',
			'player_id' => '17446',
			'email' => 'bz@jenida.com',
			'password' => '$2y$10$tfD9BXYwPTfsxD/yzLoGOe7VdgXwWin0kUWQLNwiZZ.si6aHsL5UW',
			'enabled' => 'true',
		]);

		User::create([
			'id' => '3',
			'name' => 'Jennifer Arnold',
			'player_id' => -1,
			'email' => 'jen.col.arn@gmail.com',
			'password' => '$2y$10$tfD9BXYwPTfsxD/yzLoGOe7VdgXwWin0kUWQLNwiZZ.si6aHsL5UW',
			'enabled' => 'true',
		]);

	}
}
