<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CloseThread extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threads',function(Blueprint $table){
           $table->boolean('is_closed')->default(false);
        });
        Schema::table('channels', function(Blueprint $table){
           $table->boolean('is_closed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('threads',function(Blueprint $table){
           $table->dropColumn('is_closed');
        });

        Schema::table('channels',function(Blueprint $table){
            $table->dropColumn('is_closed');
        });
    }
}
