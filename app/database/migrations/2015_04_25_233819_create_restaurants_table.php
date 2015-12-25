<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('restaurants')) {
			Schema::create("restaurants",function($table) {
				$table->engine = 'InnoDB';
				$table->increments("id");
				$table->string("name",200);
				$table->string("address",200);
				$table->string("city",200);
				$table->string("state",200);
				$table->string("zip",200);
				$table->string("country",10);
				$table->string("phone",20);
				$table->string("logo",20);
				$table->float("lat");
				$table->float("lng");
				$table->decimal("rating",5,2);
				$table->integer("views");
				$table->integer("shares");
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
