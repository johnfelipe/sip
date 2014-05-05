<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormasTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_nivel')->unsigned();
			$table->integer('id_version')->unsigned();
			$table->integer('forma');
			$table->foreign('id_nivel')->references('id')->on('niveles');
			$table->foreign('id_version')->references('id')->on('versiones');
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
		Schema::drop('formas');
	}

}
