<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailQueuesTmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('email_queue_tmps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('process_name');
            $table->string('to_email');
            $table->string('to_name');
            $table->string('from_email');
            $table->string('from_name');
            $table->text('subject');
            $table->text('body');
            $table->text('files');
            $table->tinyInteger('sent');
            $table->tinyInteger('sent_status');
            $table->tinyInteger('read_status');
            $table->timestamp('time_to_send');
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
       Schema::dropIfExists('email_queue_tmps');
    }
}
