<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parent', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('noKP');
            $table->bigInteger('noKPParent');
            $table->string('name');
            $table->string('relationship');
            $table->string('address');
            $table->string('phone');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('parent');
	}

}
