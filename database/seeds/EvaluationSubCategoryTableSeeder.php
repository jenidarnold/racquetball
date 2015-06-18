<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\EvaluationSubCategory;

class EvaluationSubCategoryTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('evaluation_subcategories')->delete();

		EvaluationSubCategory::create([
			'subcategory' => 'Forehand',			
			'category_id' => 1,
			//'category' => 'Stroke Mechanics'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Backhand',			
			'category_id' => 1,
			//'category' => 'Stroke Mechanics'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Consistency',			
			'category_id' => 1,
			//'category' => 'Stroke Mechanics'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'During rally',
			'category_id' => 2,
			//'category' => 'Court Position'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'After-serve location',
			'category_id' => 2,
			//'category' => 'Court Position'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'During return of serve',
			'category_id' => 2,
			//'category' => 'Court Position'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Offensive shots',
			'category_id' => '3',
			//'category' => 'Shot Selection'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Defensive shots',
			'category_id' => '3',
			//'category' => 'Shot Selection'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'During rally',
			'category_id' => '3',
			//'category' => 'Shot Selection'
		]);
		
		EvaluationSubCategory::create([
			'subcategory' => 'During return of serve',
			'category_id' => '3',
			//'category' => 'Shot Selection'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Variety or predictabile',
			'category_id' => '3',
			//'category' => 'Shot Selection'
		]);	

		EvaluationSubCategory::create([
			'subcategory' => 'Percentages: playing the odds',
			'category_id' => '3',
			//'category' => 'Shot Selection'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Consistency',
			'category_id' => '3',
			//'category' => 'Shot Selection'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Drives',
			'category_id' => '4',
			//'category' => 'Serves'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Lobs',
			'category_id' => '4',
			//'category' => 'Serves'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Attach serves',
			'category_id' => '5',
			//'category' => 'Return of Serve',
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Mechanics/techniques',
			'category_id' => '5',
			//'category' => 'Return of Serve',
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'During rally',
			'category_id' => '6',
			//'category' => 'Footwork'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Return of serve',
			'category_id' => '6',
			//'category' => 'Footwork'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Positive attitude',
			'category_id' => '7',
			//'category' => 'Emotional State'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Calm and in control',
			'category_id' => '7',
			//'category' => 'Emotional State'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Righty or lefty',
			'category_id' => '8',
			//'category' => 'Type of Player'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Slow or fast',
			'category_id' => '8',
			//'category' => 'Type of Player'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Uses different strategies: adjusts game plan',
			'category_id' => '9',
			//'category' => 'Miscellaneous'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Use of time-outs',
			'category_id' => '9',
			//'category' => 'Miscellaneous'
		]);
	}

}
