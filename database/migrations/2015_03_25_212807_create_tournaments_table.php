<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tournaments', function(Blueprint $table)
		{
			$table->increments('tournament_id');
			$table->string('name');	
			$table->string('location');	
			$table->date('start_date');	
			$table->date('end_date');
			$table->date('registration_date');	
			$table->string('url');	
			$table->integer('max_players');	
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
		Schema::drop('tournaments');
	}

}
