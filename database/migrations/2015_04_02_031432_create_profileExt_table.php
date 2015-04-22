<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileExtTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profileExt', function(Blueprint $table)
		{
			$table->bigInteger('noKP');
            $table->primary('noKP');
			$table->string('hairColor');
            $table->string('skinColor');
            $table->string('weight');
            $table->string('placeOB');
            $table->string('education');
            $table->text('marks');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profileExt');
	}

}
