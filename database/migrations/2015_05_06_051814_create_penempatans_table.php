<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenempatansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penempatan', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('organisasi');
            $table->text('namaPenuh');
            $table->text('alamat');
            $table->string('noTel');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('penempatan');
	}

}
