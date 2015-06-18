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
			'subcategory' => 'Mechanics/techniques',
			'category_id' => '4',
			//'category' => 'Serves'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Strategy',
			'category_id' => '4',
			//'category' => 'Serves'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Variety',
			'category_id' => '4',
			//'category' => 'Serves'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Quality/Consistency',
			'category_id' => '4',
			//'category' => 'Serves'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Deception',
			'category_id' => '4',
			//'category' => 'Serves'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Attack serves',
			'category_id' => '5',
			//'category' => 'Return of Serve',
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Mechanics/techniques',
			'category_id' => '5',
			//'category' => 'Return of Serve',
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Strategy',
			'category_id' => '5',
			//'category' => 'Return of Serve'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Footwork',
			'category_id' => '5',
			//'category' => 'Return of Serve'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Quality/Consistency',
			'category_id' => '5',
			//'category' => 'Return of Serve'
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
			'subcategory' => 'Crossover step',
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
			'subcategory' => 'Stays focued',
			'category_id' => '7',
			//'category' => 'Emotional State'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Easily upset',
			'category_id' => '7',
			//'category' => 'Emotional State'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Mentally tough',
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
			'subcategory' => 'Tall or short',
			'category_id' => '8',
			//'category' => 'Type of Player'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Big or small',
			'category_id' => '8',
			//'category' => 'Type of Player'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Power or control',
			'category_id' => '8',
			//'category' => 'Type of Player'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'In shape or out of shape',
			'category_id' => '8',
			//'category' => 'Type of Player'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Healthy or injured',
			'category_id' => '8',
			//'category' => 'Type of Player'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Counterpuncher or ripper',
			'category_id' => '8',
			//'category' => 'Type of Player'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Orthodox or unorthodox',
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

		EvaluationSubCategory::create([
			'subcategory' => 'Knowledge of the rules',
			'category_id' => '9',
			//'category' => 'Miscellaneous'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Warm-up',
			'category_id' => '9',
			//'category' => 'Miscellaneous'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Etiquette/behavior',
			'category_id' => '9',
			//'category' => 'Miscellaneous'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Pace/tempo of game',
			'category_id' => '9',
			//'category' => 'Miscellaneous'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Nutrition',
			'category_id' => '9',
			//'category' => 'Miscellaneous'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Conditioned',
			'category_id' => '9',
			//'category' => 'Miscellaneous'
		]);

		EvaluationSubCategory::create([
			'subcategory' => 'Watches the ball',
			'category_id' => '9',
			//'category' => 'Miscellaneous'
		]);
	}

}
