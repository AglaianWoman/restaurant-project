<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Validator;

//use Eloquent;
class State extends Eloquent {

	protected $rules = array(
		"name"=>"required|alpha|min:1",
		"code"=>"required|alpha|min:2|max:2",
		"country_code"=>"required|alpha|min:2|max:2|exists:countries,code"	
	);

	private $validationErrors=null;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'states';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = arr('password', 'remember_token');
	
	public function validate() {
		$validator = Validator::make($this->toArray(),$this->rules);
		if($validator->fails()) {
			$this->validationErrors = $validator->messages();
			return false;
		}
		return true;
	}
	
	public function errors() {
		return $this->validationErrors;
	}
}
