<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyLeaguematchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('league_matches', function($t){
            $t->foreign('match_id')
            ->references('match_id')
            ->on('matches')
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
        Schema::table('league_matches', function($t){
            //$t->dropForeign('league_matches_match_id_foreign');
            $t->dropForeign(['match_id']);
        });
    }
}
