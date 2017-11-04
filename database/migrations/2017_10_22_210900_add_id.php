<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_roles',function(Blueprint $table){
            $table->increments('id');
        });
        //link user and badge
        Schema::table('user_badges',function(Blueprint $table){
            $table->increments('id');
        });
        //Link item to user
        Schema::table('user_items',function(Blueprint $table){
            $table->increments('id');
        });
        //Link item to shop
        Schema::table('shop_items',function(Blueprint $table){
            $table->increments('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_roles',function(Blueprint $table){
            $table->dropColumn('id');
        });
        //link user and badge
        Schema::table('user_badges',function(Blueprint $table){
            $table->dropColumn('id');
        });
        //Link item to user
        Schema::table('user_items',function(Blueprint $table){
            $table->dropColumn('id');
        });
        //Link item to shop
        Schema::table('shop_items',function(Blueprint $table){
            $table->dropColumn('id');
        });
    }
}
