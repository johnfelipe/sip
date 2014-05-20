<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadosTempTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resultados_temp', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_evaluacion')->unsigned()->nullable();						
			$table->string('clip', 100);
			$table->integer('nivel');
			$table->integer('version');
			$table->integer('forma');
			$table->string('respuesta', 1)->nullable();
			$table->string('correcta', 1)->nullable();
			$table->integer('posicion')->nullable();
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
		Schema::drop('resultados_temp');
	}

}
