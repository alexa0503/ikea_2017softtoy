<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('wechat_users');
            $table->string('mobile',120);
            $table->date('birth_date');
            $table->string('child_name',60);
            $table->string('gender',10);
            $table->string('title',60);
            $table->string('introduction',200);
            $table->string('img_path',120);
            $table->string('comment',200)->nullable();
            $table->string('expect',200)->nullable();
            $table->integer('like_num')->unsigned();
            $table->integer('employees_like_num')->unsigned();
            $table->integer('degree')->unsigned()->nullable();
            $table->string('created_ip',120)->nullable();
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
        Schema::dropIfExists('works');
    }
}
