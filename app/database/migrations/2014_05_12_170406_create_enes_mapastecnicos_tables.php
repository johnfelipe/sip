<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnesMapastecnicosTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enes_mapastecnicos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_evaluacion')->unsigned()->nullable();
			$table->integer('nivel');
			$table->integer('id_item');
			$table->string('campo', 200);
			$table->string('funcion', 100);
			$table->string('respuesta_correcta', 100);
			$table->integer('f55')->nullable();
			$table->integer('f56')->nullable();
			$table->integer('f57')->nullable();
			$table->integer('f58')->nullable();
			$table->integer('f59')->nullable();
			$table->integer('f60')->nullable();
			$table->integer('f61')->nullable();
			$table->integer('f62')->nullable();
			$table->integer('f63')->nullable();
			$table->integer('f64')->nullable();
			$table->integer('f65')->nullable();
			$table->integer('f66')->nullable();
			$table->integer('f67')->nullable();
			$table->integer('f68')->nullable();
			$table->integer('f69')->nullable();
			$table->integer('f70')->nullable();
			$table->integer('f71')->nullable();
			$table->integer('f72')->nullable();
			$table->integer('f73')->nullable();
			$table->integer('f74')->nullable();
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
		Schema::drop('enes_mapastecnicos');
	}

}
