<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\GameFormat;

class GameFormatTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('game_formats')->delete();
		
		GameFormat::create([
			'format_id' => '1',
			'format' => '1 game to 11'
		]);

		GameFormat::create([
			'format_id' => '2',
			'format' => 'Best of 3 games to 11'
		]);

		GameFormat::create([
			'format_id' => '3',
			'format' => 'Best of 3 games to 15'
		]);

		GameFormat::create([
			'format_id' => '4',
			'format' => 'Best of 5 games to 11'
		]);
	}

}
