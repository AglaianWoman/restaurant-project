<?php
namespace Admin;
use Menu;
use Restaurant;
use View;
use Input;
use Redirect;
use Request;
use Response;
class RestaurantController extends BaseController {
	protected $layout = "layouts.admin";
	
	public function index() {
		/*$string = "9617 redfern ave inglewood,ca 90301";
		$string = str_replace (" ", "+", urlencode($string));
	   	$details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
	 
   		$ch = curl_init();
   		curl_setopt($ch, CURLOPT_URL, $details_url);
   		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   		$response = json_decode(curl_exec($ch), true);

   		print_r($response);*/
   		View::share("title","Restaurants");
   		$restaurants = Restaurant::get();
   		$this->layout->content = View::make("admin.restaurants.index")->with('restaurants',$restaurants);
	}

	public function edit($id) {
		$$restaurant = Restaurant::get($id);
		View::share("title","Edit Restaurant: ".$restaurant->name);
		$menus = Menu::where('restaurant_id',0)->orWhere('restaurant_id',$id)->get();
	}

	public function create() {
		View::share("title","Create New Restaurant");
		$menus = Menu::where('restaurant_id',0)->get();
		$restaurant = new Restaurant();
		$states = States::get();
		$countries = Countries::get();
		$this->layout->content = View::make("admin.restaurants.add")
			->with("menus",$menus)->with("restaurant",$restaurant);
	}

}