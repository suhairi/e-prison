<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('officer', function(Blueprint $table)
		{
			$table->string('staffId');
            $table->primary('staffId');
			$table->bigInteger('noKP');
            $table->string('name');
            $table->string('position');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('officer');
	}

}
