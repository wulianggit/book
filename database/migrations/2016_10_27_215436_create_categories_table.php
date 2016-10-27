<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->comment('类别ID');
            $table->integer('parent_id',0,1)->default(0)->comment('上级ID');
            $table->string('name',20)->default('')->comment('类别名称');
            $table->integer('sort',0,1)->default(0)->comment('排序');
            $table->string('preview',100)->default('')->comment('预览图地址');
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
        Schema::drop('categories');
    }
}
