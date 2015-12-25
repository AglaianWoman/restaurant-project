<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('restaurants')) {
			Schema::create("restaurants",function($table) {
				$table->increments("id");
				$table->integer("restaurant_id")->references("id")->on("restaurants");
				$table->string("day");
				$table->integer("hour_start");
				$table->integer("minute_start");
				$table->integer("hour_end");
				$table->integer("minute_end");
				$table->smallinteger("is_next_day");
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
