<?php
namespace Admin;
use Country;
use State;
use View;
use Input;
use Redirect;
use Request;
use Response;
class StateController extends BaseController {
	protected $layout = "layouts.admin";
	public function index() {
		$states = State::get();
		$countries = Country::get();
		View::share("title","States");

		$this->layout->content = View::make("admin.states.index")->with('states',$states)->with("countries",$countries);
	}
	public function create() {

	}
	
	public function update($id) {
		$state = State::find($id);

		$input = Input::all();
		try {
			$state->name = $input['state']['name'];
			$state->code = $input['state']['code'];
			$state->country_code = $input['state']['country_code'];
			$messages = array();
			$success = false;
			if($state->validate()) {
				$state->save();
				$success=true;
			} else {
					$messages = $state->errors();
			}
			
			if(Request::wantsJson()) {
				return Response::json(array('success'=>$success,'messages'=>$messages));
			} else {
			return Redirect::to("admin/states/");
			}
		} catch (Exception $e) {
			if(Request::wantsJson()) {
				return Response::json(array('success'=>false,'message'=>$e->getMessage()));
			} else {
				return Redirect::to("admin/states/");
			}
		}
		exit();
	}

	public function store() {
		$input = Input::all();
		$state = new State;
		$state->name = $input['name'];
		$state->code = $input['code'];
		$state->country_code = $input['country_code'];
		$state->save();
		return Redirect::to("admin/states");
	}
}
