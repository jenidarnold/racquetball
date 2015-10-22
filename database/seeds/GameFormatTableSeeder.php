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
			'format' => 'Singles'
		]);
		
		GameFormat::create([
			'format_id' => '2',
			'format' => 'Doubles'
		]);

		GameFormat::create([
			'format_id' => '3',
			'format' => 'Cutthroat'
		]);

		GameFormat::create([
			'format_id' => '4',
			'format' => 'In and Out'
		]);
		
		GameFormat::create([
			'format_id' => '5',
			'format' => 'Iron Man'
		]);
	}

}
