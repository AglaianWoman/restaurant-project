<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('states')) {
			Schema::create("states",function($table) {
				$table->engine = 'InnoDB';
				$table->increments("id");
				$table->string("name",200);
				$table->string("code",200);
				$table->string("country_code",200);
				

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
	}

}
