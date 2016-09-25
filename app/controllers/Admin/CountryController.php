<?php
namespace Admin;
use Country;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Session;
class CountryController extends BaseController {
	protected $layout = "layouts.admin";
	public function index() {

		$countries = Country::get();
		View::share("title","Countries");

		$this->layout->content = View::make("admin.countries.index")->with('countries',$countries);
	}



	public function jsonList() {
		$countries = Country::get();
		if(Request::wantsJson()) {
			return Response::json(
					array(
							'countries'=>$countries->toArray()
					)
					);
		} else {
			return Redirect::to("admin/countries/");
		}
	}

	public function create() {

	}

	// adds new model into database
	public function store() {
		if(Session::token() != Input::get('_token')){
			if(Request::wantsJson()) {
				return Response::json(array('success'=>false,'messages'=>"token is invalid"));
			} else {
				return Redirect::to("admin/countries/");
			}
		}
		$input = Input::all();
		$country = new Country;
		$country->name = $input['country']['name'];
		$country->code = strtoupper($input['country']['code']);
		try {
			$success = false;
			$messages = array();
			if($country->validate()) {
				$country->save();
				$success=true;
			} else {
				$messages = $country->errors();
			}
			//$country->save();
			//$success = true;
			if(Request::wantsJson()) {
				return Response::json(
						array(
								'success'=>$success,'messages'=>$messages,
								'country'=>$country->toArray()
						)
						);
			} else {
				return Redirect::to("admin/countries/");
			}
		} catch(Exception $e) {
			if(Request::wantsJson()) {
				return Response::json(
						array(
								'success'=>false,'messages'=>$e->getMessage(),'country'=>array()
						)
				);
			} else {
				return Redirect::to("admin/countries/");
			}
		}
	}

	// updates existing model in database
	public function update($id) {
		if(Session::token() != Input::get('_token')){
			if(Request::wantsJson()) {
				return Response::json(array('success'=>false,'messages'=>"token is invalid"));
			} else {
				return Redirect::to("admin/countries/");
			}
		}

		$country = Country::find($id);

		$input = Input::all();
		try {
			$country->name = $input['country']['name'];
			$country->code = strtoupper($input['country']['code']);
			$success = false;
			$messages = array();
			if($country->validate()) {
				$country->save();
				$success=true;
			} else {
				$messages = $country->errors();
			}

			if(Request::wantsJson()) {
				return Response::json(
						array(
								'success'=>$success,'messages'=>$messages,
								'country'=>$country->toArray()
						)
						);
			} else {
				return Redirect::to("admin/countries/");
			}
		} catch (Exception $e) {
			if(Request::wantsJson()) {
				return Response::json(array('success'=>false,'messages'=>$e->getMessage()));
			}
		}
		exit();
	}
}
