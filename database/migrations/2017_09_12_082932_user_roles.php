<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Link user and role
        Schema::create('user_roles',function(Blueprint $table){
           $table->integer('user_id');
           $table->integer('role_id');
        });
        //link user and badge
        Schema::create('user_badges',function(Blueprint $table){
            $table->integer('user_id');
            $table->integer('badge_id');
        });
        //Link item to user
        Schema::create('user_items',function(Blueprint $table){
            $table->integer('user_id');
            $table->integer('item_id');
        });
        //Link item to shop
        Schema::create('shop_items',function(Blueprint $table){
            $table->integer('shop_id');
            $table->integer('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('user_badges');
        Schema::dropIfExists('user_items');
        Schema::dropIfExists('shop_items');
    }
}
