<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministratorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		if(!Schema::hasTable('administrators')) {
			Schema::create("administrators",function($table) {
				$table->engine = 'InnoDB';
				$table->increments("id");
				$table->string("first_name",80);
				$table->string("last_name",80);
				$table->string("username",100);
				$table->string("email",100);
				$table->string("password",100);
				
				$table->rememberToken();
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		if(Schema::hasTable('administrators')) {
			Schema::drop("administrators");
		}
	}

}
