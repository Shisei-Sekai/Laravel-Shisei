<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserCharacterCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cards',function(Blueprint $table){
           $table->string('name');
           $table->string('avatar');
           $table->integer('age');
           $table->string('birthplace');
           $table->string('race');
           $table->text('physical_origin');
           $table->text('psyche_description');
           $table->text('history');
           $table->integer('status');
           $table->integer('owner_id')->unique(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cards');
    }
}
