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
            $table->string('height');
            $table->string('placeOB');
            $table->string('education');
            $table->text('marks');
            $table->text('bodyMarks');
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
