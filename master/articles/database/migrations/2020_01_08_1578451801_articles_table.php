<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticlesTable extends Migration
{

	public function up()
	{
		Schema::create('articles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
		 	$table->integer('order')->default(0);
      $table->text('meta')->nullable();
      $table->text('banners')->nullable();
      $table->text('banners_mobile')->nullable();
      $table->text('images')->nullable();
      $table->text('abstract')->nullable();
      $table->text('content')->nullable();
			$table->tinyinteger('status')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}
