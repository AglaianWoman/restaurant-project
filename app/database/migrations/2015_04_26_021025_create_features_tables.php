<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('features')) {
			Schema::create("features",function($table) {
				$table->engine = 'InnoDB';
				$table->increments("id");
				$table->string("name",200);
				$table->integer("display_order");
				$table->integer("type");

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
