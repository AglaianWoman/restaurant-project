<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Validator;

//use Eloquent;
class Country extends Eloquent {

	protected $rules = array(
			"name"=>"required|min:1",
			"code"=>"required|alpha|min:2|max:2"
	);
	private $validationErrors=null;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'countries';

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
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');

}
