<?php
namespace Admin;

use Menu;
use View;
use Input;
use Redirect;
use Request;
use Response;
class MenuController extends BaseController {
	protected $layout = "layouts.admin";
	
	public function test() {

	}

	public function index() {
		$all_menus = Menu::get();
		//var_dump($all_menus);
		View::share("title","Menus");
		
		$this->layout->content = View::make("admin.menus.index")->with("menus",$all_menus);
		
	}

	public function view($id) {
		echo "test ".$id;
	}

	public function add() {

	}
	public function store() {
		$input = Input::all();
		$menu = new Menu;
		$menu->name = $input['name'];
		$menu->save();
		return Redirect::to("admin/menus");
	}
	public function edit($id) {
		print_r(Menu::find($id));
		exit();
	}
	public function update($id) {
		//echo "tesing";
		$menu = Menu::find($id);
		//print_r($menu);
		$input = Input::all();
		$menu->name = $input['menu']['name'];
		$menu->save();
		if(Request::wantsJson()) {
			return Response::json(array('success'=>true));
		} /*else {
			return Redirect::to("admin/menus/".$id."/edit");
		}*/
		exit();

	}
}