<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('send_user_id')->unsigned();
            $table->foreign('send_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->bigInteger('receive_user_id')->unsigned();
            $table->foreign('receive_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->text('message_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
