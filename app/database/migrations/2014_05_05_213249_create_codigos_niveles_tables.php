<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigosNivelesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codigos_niveles', function(Blueprint $table) {
			$table->integer('codigo_evaluacion')->unsigned();
			$table->integer('niveles');
			$table->integer('niveles_inicio');
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
		Schema::drop('codigos_niveles');
	}

}
