<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigosVersionesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codigos_versiones', function(Blueprint $table) {
			$table->integer('codigo_evaluacion')->unsigned();
			$table->integer('versiones');
			$table->integer('versiones_inicio');
			$table->foreign('codigo_evaluacion')->references('id')->on('codigos_evaluaciones');			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('codigos_versiones');
	}

}
