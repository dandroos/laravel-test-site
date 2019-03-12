<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_path');
            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->tinyInteger('main_collection_image')->default(0);
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->tinyInteger('main_product_image');
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->tinyInteger('main_article_image');
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
        Schema::dropIfExists('images');
    }
}
