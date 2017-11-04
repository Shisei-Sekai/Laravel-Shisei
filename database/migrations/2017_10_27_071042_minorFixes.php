<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MinorFixes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create the "main role" column (integer to role id), to display desired role so it can have multiple ones,
        //but only show one to "public"
        //Also, create the "blocked" column, so the user can be banned until
        Schema::table('users',function (Blueprint $table){
            $table->integer('main_role')->default(2);
            $table->timestamp('blocked_on')->nullable();
        });

        //Add "description" column, should have done it in it's migration, but i forgot it.
        Schema::table('channels',function(Blueprint $table){
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function(Blueprint $table){
            $table->dropIfExists('main_role');
        });

        Schema::table('channels',function (Blueprint $table){
           $table->dropIfExists('description');
        });
    }
}
