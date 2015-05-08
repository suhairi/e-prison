<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenerimasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penerima', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('name');
            $table->text('organisasi');
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
		Schema::drop('penerima');
	}

}
