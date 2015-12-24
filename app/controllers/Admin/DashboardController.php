<?php
namespace Admin;
use \View;
class DashboardController extends BaseController {
	protected $layout = "layouts.admin";
	public function test() {

	}

	public function index() {
		View::share("title","Dashboard");
		
		$this->layout->content = View::make("admin.dashboard.index");
	}

	public function view($id) {
		echo "test ".$id;
	}

}