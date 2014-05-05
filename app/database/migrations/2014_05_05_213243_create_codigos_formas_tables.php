<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigosFormasTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codigos_formas', function(Blueprint $table) {
			$table->integer('codigo_evaluacion')->unsigned();
			$table->integer('formas');
			$table->integer('formas_inicio');
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
		Schema::drop('codigos_formas');
	}

}
