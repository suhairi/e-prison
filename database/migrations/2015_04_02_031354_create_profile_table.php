<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profile', function(Blueprint $table)
		{
			$table->bigInteger('noKP');
            $table->primary('noKP');
			$table->string('nama');
            $table->string('jobDesc');
            $table->string('race');
            $table->string('religion');
            $table->string('phone')->nullable;
            $table->string('maritalStatus');
            $table->string('photo')->nullable;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profile');
	}

}
