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
            $table->string('nrp')->index();
            $table->string('nip')->index();
            $table->string('id_topik');
            $table->integer('status');
            
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('sit_in');
	}

}
