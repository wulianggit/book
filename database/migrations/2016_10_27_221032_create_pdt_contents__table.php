<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdtContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdt_contents', function (Blueprint $table) {
            $table->increments('id')->comment('商品详情ID');
            $table->integer('product_id',0,1)->default(0)->comment('商品ID');
            $table->text('content')->default('')->comment('商品详情');
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
        Schema::drop('pdt_contents');
    }
}
