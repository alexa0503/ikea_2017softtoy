<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('wechat_users'))
            Schema::create('wechat_users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('open_id',60);
                $table->unique('open_id');
                $table->string('nick_name',60);
                $table->string('head_img',200);
                $table->tinyInteger('gender');
                $table->string('country',60);
                $table->string('province',60);
                $table->string('city',60);
                $table->string('mobile',60)->nullable();
                $table->string('name',60)->nullable();
                $table->string('ip_address',120)->nullable();
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
        //Schema::dropIfExists('wechat_users');
    }
}
