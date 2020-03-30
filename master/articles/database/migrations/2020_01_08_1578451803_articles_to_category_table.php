<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticlesToCategoryTable extends Migration
{

	public function up()
	{
    Schema::create('article_to_category', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('article_id');
      $table->integer('category_id');
      $table->timestamps();
    });
  }

	public function down()
	{
		Schema::drop('article_to_category');
	}
}
