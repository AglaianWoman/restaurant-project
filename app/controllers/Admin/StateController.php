<?php
/*
 * app/controllers/Admin/StateController.php
 */

/*
 * TODO: add delete method, functions to do search
 */
namespace Admin;
use Country;
use State;
use View;
use Input;
use Redirect;
use Request;
use Response;
use Session;
class StateController extends BaseController {
	protected $layout = "layouts.admin";
	public function index() {
		//$states = State::get();
		$countries = Country::get();
		View::share("title","States");

		$this->layout->content = View::make("admin.states.index")->with("countries",$countries);
	}
	
	public function jsonList() {
		$states = State::get();
		if(Request::wantsJson()) {
			return Response::json(
					array(
							'states'=>$states->toArray()
					)
					);
		} else {
			return Redirect::to("admin/states/");
		}
	}
	public function create() {

	}
	
	public function update($id) {
		if(Session::token() != Input::get('_token')){
			if(Request::wantsJson()) {
				return Response::json(array('success'=>false,'message'=>"token is invalid"));
			} else {
				return Redirect::to("admin/states/");
			}
		}
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
		try {
			if(Session::token() != Input::get('_token')){
				if(Request::wantsJson()) {
					return Response::json(array('success'=>false,'message'=>"token is invalid"));
				} else {
					return Redirect::to("admin/states/");
				}
			}
			$input = Input::all();
			$state = new State;
			$state->name = $input['state']['name'];
			$state->code = $input['state']['code'];
			$state->country_code = $input['state']['country_code'];
			$success = false;
			$messages = array();
			if($state->validate()) {
				$state->save();
				$success=true;
			} else {
				$messages = $state->errors();
			}
			
			if(Request::wantsJson()) {
				return Response::json( 
						array( 
								'success'=>$success,'messages'=>$messages,
								'state'=>$state->toArray()
						)
				);
			} else {
				return Redirect::to("admin/states/");
			}
			
		} catch (Exception $e) {
			if(Request::wantsJson()) {
				return Response::json( 
						array( 
								'success'=>false,'message'=>$e->getMessage(),'state'=>array()
						) 
				);
			} else {
				return Redirect::to("admin/states/");
			}
		}
		exit();
	}
}
