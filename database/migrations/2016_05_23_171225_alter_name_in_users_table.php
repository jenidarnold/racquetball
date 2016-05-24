<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNameInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::statement('ALTER TABLE users CHANGE name first_name varchar(100)');
        Schema::table('users', function($t){
            $t->string('last_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        DB::statement('ALTER TABLE users CHANGE first_name name varchar(100)');
        Schema::table('users', function($t){
            $t->dropColumn('last_name');
        });
    }
}
