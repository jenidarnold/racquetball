<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScoresToGamesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table('games', function($t){
			$t->integer('score1');
		});
		Schema::table('games', function($t){
			$t->string('score2');
		});
		Schema::table('games', function($t){
			$t->string('minutes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('games', function($t){
			$t->dropColumn('score1');
			$t->dropColumn('score2');
			$t->dropColumn('minutes');
		});
	}

}
