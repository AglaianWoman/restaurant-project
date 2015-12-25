<?php

class RestaurantController extends BaseController {

	public function test() {

	}

	public function index() {
		echo "testing index";
	}

	public function view($id) {
		echo "test ".$id;
	}

}