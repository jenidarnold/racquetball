<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rankings', function(Blueprint $table)
		{
			$table->increments('ranking_id');
			$table->date('ranking_date');	
			$table->integer('player_id');	
			$table->integer('ranking');	
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
		Schema::drop('rankings');
	}

}
