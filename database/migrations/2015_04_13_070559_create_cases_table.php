<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('caseNo');
            $table->bigInteger('noKP');
            $table->string('seksyenKesalahan');
            $table->string('memoTerima');
            $table->string('memoPolis');
            $table->string('memoSelesai');
            $table->string('noDaftar');
            $table->integer('officer');
            $table->integer('penyelia');
            $table->text('hukuman');
            $table->integer('mahkamah');
            $table->date('tarikhMasuk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cases');
    }

}
