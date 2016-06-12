<?php
namespace Admin;
use \View;
use Administators;
use Auth;
use Input;
use Redirect;
class DashboardController extends BaseController {
	protected $layout = "layouts.admin";
	public function test() {
	echo "test";
	View::share("title","Dashboard");
	
	$this->layout->content = View::make("admin.dashboard.index");
	}
	public function login() {
		View::share("title","Dashboard");
		$this->layout = View::make('layouts.login');
		$this->layout->content = View::make("admin.dashboard.login");
	}
	public function loginPost() {
		if(Auth::administrator()->attempt(
				array("email"=>Input::get("email"), 
					  "password"=>Input::get("password")) ) ) {
					return Redirect::intended("admin/dashboard");
				}
				else {
					return Redirect::to("admin/login");
				}
	}
	
	
	public function show() {
		View::share("title","Dashboard");
		
		$this->layout->content = View::make("admin.dashboard.index");
	}
	public function index() {
		View::share("title","Dashboard");
		
		$this->layout->content = View::make("admin.dashboard.index");
	}

	public function view($id) {
		echo "test ".$id;
	}

}