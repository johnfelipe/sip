<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('niveles', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_evaluacion')->unsigned();
			$table->integer('nivel');
			$table->string('descripcion', 200);
			$table->integer('preguntas');
			$table->integer('preguntas_operativas');
			$table->foreign('id_evaluacion')->references('id')->on('evaluaciones');
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
		Schema::drop('niveles');
	}

}
