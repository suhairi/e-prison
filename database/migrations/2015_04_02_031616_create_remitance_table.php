<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemitanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('remitance', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('caseNo');
            $table->date('tarikhHukum');
            $table->date('tarikhLewat');
            $table->date('tarikhAwal');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('remitance');
	}

}
