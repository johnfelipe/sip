<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormasTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_evaluacion')->unsigned()->nullable();
			$table->integer('nivel');
			$table->integer('version');
			$table->integer('forma');
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
		Schema::drop('formas');
	}

}
