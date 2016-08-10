@extends("layouts.admin")
@section("content")
<div class="col-md-12">Create New Restaurant</div>
<div class="col-md-12" ng-app="restaurantApp" >
<from method="post" action="<% URL::to("admin/restaurants/store") %>" ng-controller="restaurantCtrl" data-ng-init="init()">
	<?php echo Form::token();?>
	<label>Restaurant Name</label>
	<input type="text" name="name" />
	<label>Address</label>
	<input type="text" name="address" />
	<label>City</label>
	<input type="text" name="city" />
	<label>State</label>
	<select name="state">
		<option ng-repeat="state in states" value="{{state.code}}">
			{{state.name}}
		</option>
	</select>
</form>
</div>
<script type="text/javascript">
	var restaurantCtrl = angular.module("restaurantApp.Ctrl",[]);
	restaurantCtrl.constant("CSRF_TOKEN","<?php echo csrf_token(); ?>");
	restaurantCtrl.constant("states_url","<?php echo URL::to("admin/states/json-list")?>");
	restaurantCtrl.constant("countries_url","<?php echo URL::to("admin/countries/json-list");?>");
	restaurantCtrl.controller("restaurantCtrl",
		function($scope,$http,$filter,states_url,countries_url,CSRF_TOKEN) {
		$scope.states = null;
		$scope.countries = null;
		$scope.init = function() {
			$http.get(states_url).success(function(data,status,headers,config){
				$scope.states = data.states;
			});

			$http.get(countries_url).success(function(data,status,headers,config){
				$scope.counties = data.countries;
			});



		}
	});

	var restaurantApp = angular.module("restaurantApp",['restaurantApp.Ctrl']);
</script>
@stop
