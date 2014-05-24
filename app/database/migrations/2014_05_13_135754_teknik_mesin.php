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
        Schema::create('sit_in', function($table)
        {
            $table->increments('id_sit_in');
            $table->string('nrp_mahasiswa');
            $table->string('nip_dosen');
            $table->string('id_topik');
            $table->integer('status');
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
        Schema::drop('sit_in');
	}

}
