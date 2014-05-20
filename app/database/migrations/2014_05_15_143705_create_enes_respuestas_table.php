<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnesRespuestasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enes_respuestas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_evaluacion')->unsigned()->nullable();
			$table->string('clip', 100);
			$table->integer('nivel');
			$table->integer('version');
			$table->integer('forma');
			$table->string('p1', 1)->nullable();
			$table->string('p2', 1)->nullable();
			$table->string('p3', 1)->nullable();
			$table->string('p4', 1)->nullable();
			$table->string('p5', 1)->nullable();
			$table->string('p6', 1)->nullable();
			$table->string('p7', 1)->nullable();
			$table->string('p8', 1)->nullable();
			$table->string('p9', 1)->nullable();
			$table->string('p10', 1)->nullable();
			$table->string('p11', 1)->nullable();
			$table->string('p12', 1)->nullable();
			$table->string('p13', 1)->nullable();
			$table->string('p14', 1)->nullable();
			$table->string('p15', 1)->nullable();
			$table->string('p16', 1)->nullable();
			$table->string('p17', 1)->nullable();
			$table->string('p18', 1)->nullable();
			$table->string('p19', 1)->nullable();
			$table->string('p20', 1)->nullable();
			$table->string('p21', 1)->nullable();
			$table->string('p22', 1)->nullable();
			$table->string('p23', 1)->nullable();
			$table->string('p24', 1)->nullable();
			$table->string('p25', 1)->nullable();
			$table->string('p26', 1)->nullable();
			$table->string('p27', 1)->nullable();
			$table->string('p28', 1)->nullable();
			$table->string('p29', 1)->nullable();
			$table->string('p30', 1)->nullable();
			$table->string('p31', 1)->nullable();
			$table->string('p32', 1)->nullable();
			$table->string('p33', 1)->nullable();
			$table->string('p34', 1)->nullable();
			$table->string('p35', 1)->nullable();
			$table->string('p36', 1)->nullable();
			$table->string('p37', 1)->nullable();
			$table->string('p38', 1)->nullable();
			$table->string('p39', 1)->nullable();
			$table->string('p40', 1)->nullable();
			$table->string('p41', 1)->nullable();
			$table->string('p42', 1)->nullable();
			$table->string('p43', 1)->nullable();
			$table->string('p44', 1)->nullable();
			$table->string('p45', 1)->nullable();
			$table->string('p46', 1)->nullable();
			$table->string('p47', 1)->nullable();
			$table->string('p48', 1)->nullable();
			$table->string('p49', 1)->nullable();
			$table->string('p50', 1)->nullable();
			$table->string('p51', 1)->nullable();
			$table->string('p52', 1)->nullable();
			$table->string('p53', 1)->nullable();
			$table->string('p54', 1)->nullable();
			$table->string('p55', 1)->nullable();
			$table->string('p56', 1)->nullable();
			$table->string('p57', 1)->nullable();
			$table->string('p58', 1)->nullable();
			$table->string('p59', 1)->nullable();
			$table->string('p60', 1)->nullable();
			$table->string('p61', 1)->nullable();
			$table->string('p62', 1)->nullable();
			$table->string('p63', 1)->nullable();
			$table->string('p64', 1)->nullable();
			$table->string('p65', 1)->nullable();
			$table->string('p66', 1)->nullable();
			$table->string('p67', 1)->nullable();
			$table->string('p68', 1)->nullable();
			$table->string('p69', 1)->nullable();
			$table->string('p70', 1)->nullable();
			$table->string('p71', 1)->nullable();
			$table->string('p72', 1)->nullable();
			$table->string('p73', 1)->nullable();
			$table->string('p74', 1)->nullable();
			$table->string('p75', 1)->nullable();
			$table->string('p76', 1)->nullable();
			$table->string('p77', 1)->nullable();
			$table->string('p78', 1)->nullable();
			$table->string('p79', 1)->nullable();
			$table->string('p80', 1)->nullable();
			$table->string('p81', 1)->nullable();
			$table->string('p82', 1)->nullable();
			$table->string('p83', 1)->nullable();
			$table->string('p84', 1)->nullable();
			$table->string('p85', 1)->nullable();
			$table->string('p86', 1)->nullable();
			$table->string('p87', 1)->nullable();
			$table->string('p88', 1)->nullable();			
			$table->string('p89', 1)->nullable();
			$table->string('p90', 1)->nullable();
			$table->string('p91', 1)->nullable();
			$table->string('p92', 1)->nullable();
			$table->string('p93', 1)->nullable();
			$table->string('p94', 1)->nullable();
			$table->string('p95', 1)->nullable();
			$table->string('p96', 1)->nullable();
			$table->string('p97', 1)->nullable();
			$table->string('p98', 1)->nullable();
			$table->string('p99', 1)->nullable();
			$table->string('p100', 1)->nullable();
			$table->string('p101', 1)->nullable();
			$table->string('p102', 1)->nullable();
			$table->string('p103', 1)->nullable();
			$table->string('p104', 1)->nullable();
			$table->string('p105', 1)->nullable();
			$table->string('p106', 1)->nullable();
			$table->string('p107', 1)->nullable();
			$table->string('p108', 1)->nullable();
			$table->string('p109', 1)->nullable();
			$table->string('p110', 1)->nullable();
			$table->string('p111', 1)->nullable();
			$table->string('p112', 1)->nullable();
			$table->string('p113', 1)->nullable();
			$table->string('p114', 1)->nullable();
			$table->string('p115', 1)->nullable();
			$table->string('p116', 1)->nullable();
			$table->string('p117', 1)->nullable();
			$table->string('p118', 1)->nullable();
			$table->string('p119', 1)->nullable();
			$table->string('p120', 1)->nullable();
			$table->integer('total_rv_con_piloto')->nullable();
			$table->integer('total_rv_sin_piloto')->nullable();
			$table->integer('total_rn_con_piloto')->nullable();
			$table->integer('total_rn_sin_piloto')->nullable();
			$table->integer('total_ra_con_piloto')->nullable();
			$table->integer('total_ra_sin_piloto')->nullable();
			$table->integer('total_con_piloto')->nullable();
			$table->integer('total_sin_piloto')->nullable();
			$table->integer('inev_con_piloto')->nullable();
			$table->integer('inev_sin_piloto')->nullable();
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
		Schema::drop('enes_respuestas');
	}

}
