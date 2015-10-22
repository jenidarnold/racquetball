<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leagues', function(Blueprint $table)
		{
			$table->increments('league_id');
			$table->string('name');	
			$table->integer('location_id');	
			$table->date('start_date');	
			$table->date('end_date');
			$table->string('url');	
			$table->integer('format_id');	
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
		Schema::drop('leagues');
	}

}
