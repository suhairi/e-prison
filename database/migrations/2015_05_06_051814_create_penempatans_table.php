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
            $table->text('alamat1');
            $table->text('alamat2');
            $table->text('alamat3');
            $table->text('alamat4');
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
