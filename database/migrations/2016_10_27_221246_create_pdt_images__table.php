<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdtImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdt_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id',0,1)->default(0)->comment('商品ID');
            $table->tinyInteger('sort',0,1)->default(0)->comment('排序');
            $table->string('img_path',100)->default('')->comment('图片地址');
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
        Schema::drop('pdt_images');
    }
}
