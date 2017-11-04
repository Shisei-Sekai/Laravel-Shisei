<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ThreadsAndReplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories',function (Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->timestamp('timestamp');
        });
        Schema::create('channels',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('category_id');
            $table->timestamp('timestamp');
        });
        Schema::create('threads',function(Blueprint $table){
            $table->increments('id');
            $table->string('title')->nullable(false);
            $table->string('slug');
            $table->integer('channel_id');
            $table->integer('user_id');
            $table->timestamp('timestamp');
        });
        Schema::create('posts',function(Blueprint $table){
            $table->increments('id');
            $table->string('text')->nullable(false);
            $table->integer('thread_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('threads');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('channels');
        Schema::dropIfExists('categories');
    }
}
