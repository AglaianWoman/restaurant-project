<?php
namespace Admin;
use View;
use Auth;
use Administrator;
use Route;
class BaseController extends \Controller {
	
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}