<?php
namespace Admin;
use Country;
use View;
use Input;
use Redirect;
use Request;
use Response;
class CountryController extends BaseController {
	protected $layout = "layouts.admin";
	public function index() {
		
		$countries = Country::get();
		View::share("title","Countries");

		$this->layout->content = View::make("admin.countries.index")->with('countries',$countries);
	}
	public function create() {

	}

	public function store() {
		$input = Input::all();
		$country = new Country;
		$country->name = $input['name'];
		$country->code = $input['code'];
		$country->save();
		return Redirect::to("admin/countries");
	}

	public function update($id) {
		$country = Country::find($id);
		//print_r($menu);
		$input = Input::all();
		try {
			$country->name = $input['country']['name'];
			$country->code = $input['country']['code'];
			$country->save();
			if(Request::wantsJson()) {
				return Response::json(array('success'=>true));
			} /*else {
				return Redirect::to("admin/menus/".$id."/edit");
			}*/
		} catch (Exception $e) {
			if(Request::wantsJson()) {
				return Response::json(array('success'=>false,'message'=>$e->getMessage()));
			}
		}
		exit();
	}
}