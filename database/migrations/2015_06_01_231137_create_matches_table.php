<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function(Blueprint $table)
		{
			$table->increments('match_id');
			$table->integer('tournament_id');
			$table->integer('match_type');				
			$table->integer('match_division');	
			$table->integer('player1_id');	
			$table->integer('player2_id');	
			$table->date('match_date');	
			$table->integer('winner_id');
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
		Schema::drop('matches');
	}

}
