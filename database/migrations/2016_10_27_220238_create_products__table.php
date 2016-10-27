<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->comment('商品ID');
            $table->integer('parent_id',0,1)->default(0)->comment('上级商品ID');
            $table->integer('cate_id',0,1)->default(0)->comment('分类ID');
            $table->string('name',50)->default('')->comment('商品名称');
            $table->decimal('price' ,10, 2)->default(0.00)->comment('商品价格');
            $table->string('introduce', 200)->default('')->comment('商品简介');
            $table->string('preview',100)->default('')->comment('商品预览图');
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
        Schema::drop('products');
    }
}
