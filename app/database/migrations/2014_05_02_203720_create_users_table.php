<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->string('id', 20)->primary();
            $table->string('fullname', 128);
            $table->string('password', 64);            
            $table->timestamps();
            $table->string('remember_token',100)->nullable();
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			Schema::drop('users');
		});
	}

}
