<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Shops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('vendor_id');
            $table->string('description');
            $table->timestamp('timestamp');
        });

        Schema::create('vendors',function(Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->string('description');
           $table->string('image');
           $table->timestamp('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
        Schema::dropIfExists('vendors');
    }
}
