<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePusatKehadiransTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pusat_kehadiran', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('desc');
            $table->integer('daerah');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pusat_kehadiran');
	}

}
