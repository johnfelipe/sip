<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluaciones', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nombre', 100);
			$table->string('descripcion', 300);
			$table->integer('estado');
			$table->string('user_id',20)->unsigned();
			$table->integer('id_codigo_evaluacion')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('id_codigo_evaluacion')->references('id')->on('codigos_evaluaciones');
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
		Schema::drop('evaluaciones');
	}

}
