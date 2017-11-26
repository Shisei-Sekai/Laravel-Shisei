<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChatBoxMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_messages',function(Blueprint $table){
           $table->increments('id');
           $table->integer('sender');
           $table->integer('addressee');
           $table->text('text');
           $table->boolean('readed')->default(false);
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
        Schema::dropIfExists('private_messages');
    }
}
