<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('versiones', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_evaluacion')->unsigned()->nullable();
			$table->integer('version');
			$table->foreign('id_evaluacion')
				->references('id')->on('evaluaciones')
				->onDelete('set null');
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
		Schema::drop('versiones');
	}

}
