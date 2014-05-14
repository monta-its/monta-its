<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeknikMesin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('sitin', function($table)
        {
            $table->increments('kode_sitin');
            $table->string('nrp_mahasiswa');
            $table->string('nip_dosen');
            $table->string('id_topik');
            $table->boolean('disetujui');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('sitin');
	}

}
