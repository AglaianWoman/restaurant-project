<?php

class RestaurantController extends BaseController {

	public function test() {

	}

	public function index() {
		$range = new \DateRange\Relative(array('length'=>'60 DAY', 'interval'=>'P1D'));
		var_dump($range->getRange());
		echo "testing index";
	}

	public function view($id) {
		echo "test ".$id;
	}

}