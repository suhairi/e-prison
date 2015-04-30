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
            $table->string('caseNo');
            $table->primary('caseNo');
            $table->bigInteger('noKP');
            $table->string('seksyenKesalahan');
            $table->string('memoTerima');
            $table->string('memoPolis');
            $table->string('memoSelesai');
            $table->string('noDaftar');
            $table->text('hukuman');
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
