<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id')->comment('用户ID');
            $table->string('nickname',20)->default('')->comment('用户昵称');
            $table->string('mobile',15)->default('')->comment('用户手机号');
            $table->string('email',15)->default('')->comment('用户邮箱');
            $table->string('token',60)->default('')->comment('用户邮箱验证token');
            $table->timestamp('deadline')->default(0)->comment('token过期时间');
            $table->string('password',60)->default('')->comment('密码');
            $table->tinyInteger('active',0,1)->default(0)->comment('注册用户是否为激活状态 0:否 1:是');
            $table->rememberToken();
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
        Schema::drop('members');
    }
}
