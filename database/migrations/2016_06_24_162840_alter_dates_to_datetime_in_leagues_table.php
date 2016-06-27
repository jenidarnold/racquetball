<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDatesToDatetimeInLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leagues', function($t){
            $t->datetime('start_time');
            $t->datetime('end_time');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leagues', function($t){
            $t->dropColumn('start_time');
            $t->dropColumn('end_time');
        });
    }
}
