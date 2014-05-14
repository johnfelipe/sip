<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesMapastecnicosTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluaciones_mapastecnicos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_evaluacion')->unsigned()->nullable();
			$table->integer('id_codigo_evaluacion')->unsigned();
			$table->string('mapatecnico_tabla', 100);
			$table->string('mapatecnico_archivo', 100);
			$table->string('user_id',20)->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('id_evaluacion')
				->references('id')->on('evaluaciones')
				->onDelete('set null');
			$table->foreign('id_codigo_evaluacion')
				->references('id')->on('codigos_evaluaciones');
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
		Schema::drop('evaluaciones_mapastecnicos');
	}

}
