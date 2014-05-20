<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigosEvaluacionesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codigos_evaluaciones', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nombre', 50);
			$table->string('mapa_tecnico', 200);
			$table->string('respuestas', 200);
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
		Schema::drop('codigos_evaluaciones');
	}

}
