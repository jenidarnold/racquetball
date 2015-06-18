<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluation_scores', function(Blueprint $table)
		{
			$table->integer('evaluation_id');
			$table->integer('category_id');
			$table->integer('subcategory_id');
			$table->integer('score');
			$table->string('comment');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('evaluation_scores');
	}

}
