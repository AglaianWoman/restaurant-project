@extends("layouts.admin")
@section("content")
<div class="col-md-12 col-sm-12"></div>

<div class='col-md-12 col-sm-12' ng-app="countryApp">
<div ng-controller="countryCtrl">
<form method="post">
<input type="text" ng-model="country.name" placeholder="name" required />
<input type="text" ng-model="country.code" ng-keyup="uppercase(country,'code')" placeholder="code" required />
<button  ng-click="add(country)" class="btn btn-large btn-success">Add</button>
</form>
<table class="table">
	<thead>
		<tr>
			<th ng-click="sortBy='name';sortReverse=!sortReverse">Country
			<span ng-show="sortBy=='name' && !sortReverse" class="fa fa-caret-down"></span>
				<span ng-show="sortBy=='name' && sortReverse" class="fa fa-caret-up"></span>
			</th>
			<th ng-click="sortBy='code';sortReverse=!sortReverse">Code
			<span ng-show="sortBy=='code' && !sortReverse" class="fa fa-caret-down"></span>
				<span ng-show="sortBy=='code' && sortReverse" class="fa fa-caret-up"></span>
			</th>
			<th>Actions</th>
		</tr>
	</thead>
<tr ng-repeat="country in countries" data-id="{{country.id}}">
	<td>
		<span ng-hide="country.editing" ng-dblclick="edit(country)">{{country.name}}</span>
		<input required ng-show="country.editing" type="text" ng-model="country.name" />
		<div class="btn-danger" ng-show="country.errors.name.length" ng-repeat="error in country.errors.name">{{error}}</div>
	</td>
	<td>
		<span ng-hide="country.editing" ng-dblclick="edit(country)">{{country.code}}</span>
		<input required ng-show="country.editing" type="text" ng-model="country.code" ng-keyup="uppercase(country,'code')" />
		<div class="btn-danger" ng-show="country.errors.code.length" ng-repeat="error in country.errors.code">{{error}}</div>
	</td>
	 <td>
     <button ng-disabled="!country.editing" class="btn btn-success" ng-click="update(country)">Save</button>
     <button ng-disabled="!country.editing" class="btn btn-danger" ng-click="cancel(country)">Cancel</button>
   </td>
</tr>
</table>
</div>
</div>
<script type="text/javascript">
var countries = <?php echo $countries->toJson();?>;
for (var i =0; i < countries.length;i++) {
	countries[i].editing = false;
}

var countryCtrls = angular.module("countryApp.Ctrl",[]);
countryCtrls.constant("CSRF_TOKEN","<?php echo csrf_token()?>");
countryCtrls.constant("save_url","<?php echo URL::to("admin/countries"); ?>");
countryCtrls.controller("countryCtrl",function($scope,$http,$filter,save_url,CSRF_TOKEN) {
	$scope.sortBy = 'name';
	$scope.sortReverse = false;

	$scope.countries = countries;
	$scope.original = {};
	$scope.edit = function(obj) {

		$scope.original[obj.id] = angular.copy(obj);
		//console.log($scope.original);

		obj.editing=true;
	};

	$scope.add = function(obj) {
		var data = {country:obj};
		data['_token'] = CSRF_TOKEN;
		$http.post(save_url, data).success(function(data,status,headers,config) {
			if(!data.success) {
				if(typeof data.messages==="string") {
					alert(data.messages);
				}
				else {
					obj.errors = data.messages;
				}
			} else {
				obj.name="";
				obj.code="";
				obj.errors = [];
				$scope.countries.push(data.country);
			}
		});
	}

	$scope.update = function(obj) {
		var id= obj.id;
		var data = {country:obj};
		data['_token'] = CSRF_TOKEN;
		$http.patch(save_url+"/"+obj.id,data).
		success(function(data, status, headers, config){
			if(!data.success) {
				if(typeof data.messages==="string") {
					alert(data.messages);
				}
				else {
					obj.errors = data.messages;
				}
			} else {
				obj.editing= false;
				obj.errors = [];
				delete $scope.original[id];
			}
		}).
		error(function(data, status, headers, config){});

	};

	$scope.cancel = function(obj) {
		var id = obj.id;
		angular.forEach($scope.original[id],function(value,key) {
			console.log(value);
			obj[key] = value;
		});
		obj.editing=false;
		delete $scope.original[id];

	}

	$scope.uppercase = function(obj,val) {
		obj[val] = $filter("uppercase")(obj[val]);
	}
});
var countryApp = angular.module("countryApp",['countryApp.Ctrl']);

</script>
@stop
