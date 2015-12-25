<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('restaurant_items')) {
			Schema::create("restaurant_items",function($table) {
				$table->engine = 'InnoDB';
				$table->increments("id");
				$table->string("menu_id",200);
				$table->string("name",200);
				$table->string("description",200);
				
				$table->decimal("price",5,2);
				
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
