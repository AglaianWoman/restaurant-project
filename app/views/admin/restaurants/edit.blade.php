@extends("layouts.admin")
@section("content")
<div class="col-md-12">Create New Restaurant</div>
<div class="col-md-12" ng-app="restaurantApp" >
<from id="restaurant-admin-form" class="form-horizontal" method="post" action="<% URL::to("admin/restaurants/store") %>" ng-controller="restaurantCtrl" data-ng-init="init()">
	<?php echo Form::token();?>
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#general">General</a></li>
		<li><a data-toggle="tab" href="#images">Images</a></li>
	  <li><a data-toggle="tab" href="#menu">Menus</a></li>
	  <li><a data-toggle="tab" href="#meta">Meta</a></li>
		<li><a data-toggle="tab" href="#hours">Hours</a></li>
	</ul>

	<div class="tab-content restaurant-tabs">
  <div id="general" class="tab-pane fade in active">
		<div class="form-group">
				<div class="col-sm-3 text-right">
			<label for="name">Restaurant Name</label>
		</div>
			<div class="col-sm-9">
			<input type="text" name="name" id="name" />
		</div>
		</div>
		<div class="form-group">
			<div class="col-sm-3 text-right">
				<label id="address">Address</label>
			</div>
			<div class="col-sm-9">
			<input type="text" name="address" id="address" />
		</div>
		</div>
			<div class="form-group">
					<div class="col-sm-3 text-right">
				<label for="city">City</label>
			</div>
			<div class="col-sm-9">
				<input type="text" name="city" id="city" />
			</div>
			</div>
			<div class="form-group">
				<div class="col-sm-3 text-right">
				<label for="zipcode">Zip Code</label>
			</div>
			<div class="col-sm-9">
				<input type="text" name="zip" id="zipcode" />
			</div>
			</div>
			<div class="form-group">
				<div class="col-sm-3 text-right">
				<label for="state">State</label>
			</div>
			<div class="col-sm-9">
				<select name="state" id="state">
					<option ng-repeat="state in states" value="{{state.code}}">
						{{state.name}}
					</option>
				</select>
			</div>
		</div>
			<div class="form-group">
			<div class="col-sm-3 text-right">
				<label for="country">Country</label>
			</div>
			<div class="col-sm-9">
				<select name="country" id="country">
					<option ng-repeat="country in countries" value="{{country.code}}">
						{{country.name}}
					</option>
				</select>
			</div>
			</div>
  </div>
  <div id="images" class="tab-pane fade">
fsdfs
  </div>
  <div id="menu" class="tab-pane fade">
fdsfs
  </div>
	<div id="meta" class="tab-pane fade">
fsdfs
  </div>
	<div id="hours" class="tab-pane fade">
fsdf
  </div>
</div>

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
				$scope.countries = data.countries;
			});



		}
	});

	var restaurantApp = angular.module("restaurantApp",['restaurantApp.Ctrl']);
</script>
@stop
