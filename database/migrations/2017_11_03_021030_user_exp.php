<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserExp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->integer('exp')->default(0);
        });
        Schema::table('roles',function(Blueprint $table){
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
        Schema::table('users',function (Blueprint $table){
            $table->dropColumn('exp');
        });
        Schema::table('roles',function (Blueprint $table){
            $table->dropColumn('color');
        });
    }
}
