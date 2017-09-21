<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('admin_user_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('platform');
            $table->string('ip');
            $table->timestamp('login');
            $table->integer('current_login_status'); 
            $table->timestamp('logout')->nullable();
           // $table->rememberToken();
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('admin_user_logs');
    }
}
