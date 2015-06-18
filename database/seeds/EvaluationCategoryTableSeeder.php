<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\EvaluationCategory;

class EvaluationCategoryTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('evaluation_categories')->delete();

		EvaluationCategory::create([
			'category_id' => '1',
			'category' => 'Stroke Mechanics'
		]);
		
		EvaluationCategory::create([
			'category_id' => '2',
			'category' => 'Court Position'
		]);

		EvaluationCategory::create([
			'category_id' => '3',
			'category' => 'Shot Selection'
		]);
		
		EvaluationCategory::create([
			'category_id' => '4',
			'category' => 'Serves'
		]);

		EvaluationCategory::create([
			'category_id' => '5',
			'category' => 'Return of Serve',
		]);

		EvaluationCategory::create([
			'category_id' => '6',
			'category' => 'Footwork'
		]);

		EvaluationCategory::create([
			'category_id' => '7',
			'category' => 'Emotional State'
		]);

		EvaluationCategory::create([
			'category_id' => '8',
			'category' => 'Type of Player'
		]);

		EvaluationCategory::create([
			'category_id' => '9',
			'category' => 'Miscellaneous'
		]);
	}

}
