<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories',function(Blueprint $table){
            $table->string('image')->default("https://a.pomf.cat/gecfnp.jpg"); //Using external pomf, kill me pls k thx
            $table->string('color')->default('#1CE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories',function(Blueprint $table){
            $table->dropIfExists('image');
            $table->dropIfExists('color');
        });
    }
}
