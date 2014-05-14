<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRazonamientoMapastecnicosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('raz_mapastecnicos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_evaluacion')->unsigned()->nullable();
			$table->integer('nivel');
			$table->integer('id_item');
			$table->string('campo', 200);
			$table->string('funcion', 100);
			$table->string('respuesta_correcta', 100);
			$table->integer('f1')->nullable();
			$table->integer('f2')->nullable();
			$table->integer('f3')->nullable();
			$table->integer('f4')->nullable();
			$table->integer('f5')->nullable();
			$table->integer('f6')->nullable();
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
		Schema::drop('raz_mapastecnicos');
	}

}
