<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyMatchGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('matches_games', function($t){
            $t->foreign('game_id')
            ->references('id')
            ->on('games')
            ->onDelete('cascade');

            $t->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('match_games', function($t){
            $t->dropForeign(['game_id']);
        });
    }
}
