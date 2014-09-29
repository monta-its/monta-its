<?php
/**
 * Authorization Migration
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthenticationAuthorization extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function($table)
        {
            $table->increments('id_user');
            $table->string('password_user');
            $table->string('person_id')->index();
            $table->string('person_type');
            $table->string('email_user');
            $table->string('name_user');
            $table->string('address_user');
            $table->string('contact_user');
            $table->string('gender_user');
            $table->string('remember_token_user')->nullable();
            $table->dateTime('last_login_user');
            $table->string('last_ip_user');
            $table->integer('acting_group_user');
            $table->boolean('enabled');

            
        });

        Schema::create('group', function($table)
        {
            $table->increments('id_group');
            $table->string('name_group')->index();
            $table->integer('level_group')->index();
            $table->boolean('enabled');
            
            
        });

        Schema::create('menu', function($table)
        {
            $table->increments('id_menu');
            $table->integer('parent_id');
            $table->string('name_menu')->index();
            $table->string('url_menu');
            $table->integer('order_menu');
            $table->boolean('enabled');
            
            
        });

        Schema::create('permission', function($table)
        {
            $table->increments('id_permission');
            $table->string('route_permission')->index();
            $table->boolean('enabled');
            
            
        });

        Schema::create('user_group', function($table)
        {
            $table->increments('id_user_group');
            $table->integer('user_id')->index();
            $table->integer('group_id')->index();
            
            
        });

        Schema::create('group_menu', function($table)
        {
            $table->increments('id_group_menu');
            $table->integer('group_id')->index();
            $table->integer('menu_id')->index();
            
            
        });

        Schema::create('group_permission', function($table)
        {
            $table->increments('id_group_permission');
            $table->integer('group_id')->index();
            $table->integer('permission_id')->index();
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('group');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('permission');
        Schema::dropIfExists('user_group');
        Schema::dropIfExists('group_menu');
        Schema::dropIfExists('group_permission');
    }

}
