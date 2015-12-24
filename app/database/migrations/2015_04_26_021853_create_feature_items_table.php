<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('feature_items')) {
			Schema::create("feature_items",function($table) {
				$table->engine = 'InnoDB';
				$table->increments("id");
				$table->integer("feature_id")->references("id")->on("features");
				$table->string("name",200);
				$table->integer("display_order");
				

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
