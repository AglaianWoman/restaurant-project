@extends("layouts.admin")
@section("content")

<!-- 
TODO: 
add sorting functionality for all three fields. 
pagination, and search bar.
everything should stay in one page. no refreshes.
 -->
 
<div class='col-md-12 col-sm-12' ng-app="stateApp">
<form method="post" ng-controller="stateCtrl">
	<div class="col-md-3 col-lg-3">
		<input type="text" placeholder="name" ng-model="newState.name" required  />
		<div class="btn-danger" ng-show="newState.errors.name.length" ng-repeat="error in newState.errors.name">{{error}}</div>
	</div>
	<div class="col-md-3 col-lg-3">
		<input type="text" placeholder="code" ng-keyup="uppercase(newState,'code')" ng-model="newState.code" required />
		<div class="btn-danger" ng-show="newState.errors.code.length" ng-repeat="error in newState.errors.code">{{error}}</div>
	</div>
	<div class="col-md-3 col-lg-3">
		<select ng-model="newState.country_code" required>
			<option ng-repeat="country in countries" value="{{country.code}}">
				{{country.name}}
			</option>
		</select>
		<div class="btn-danger" ng-show="newState.errors.country_code.length" ng-repeat="error in newState.errors.country_code">{{error}}</div>
	</div>
	<div class="col-md-3 col-lg-3">
		<button ng-click="addState(newState)" class="btn btn-large btn-success">Add</button>
	</div>
</form>

	<table class="table" ng-controller="stateCtrl" data-ng-init="init()">
		<thead>
			<tr>
				<th>State/Province</th>
				<th>Code</th>
				<th>Country</th>
				<th>Actions</th>
			</tr>
		</thead>
	
		<tbody>
			<tr ng-repeat="state in states | orderBy: 'name'" data-id="{{state.id}}">
				<td>
					<span ng-hide="state.editing" ng-dblclick="edit(state)">{{state.name}}</span>
					<input ng-show="state.editing" type="text" ng-model="state.name" />
					<div class="btn-danger" ng-show="state.errors.name.length" ng-repeat="error in state.errors.name">{{error}}</div>
				</td>
				<td>
					<span ng-hide="state.editing" ng-dblclick="edit(state)">{{state.code | uppercase}}</span>
					<input ng-keyup="uppercase(state,'code')" ng-show="state.editing" type="text" ng-model="state.code" />
					<div class="btn-danger" ng-show="state.errors.code.length" ng-repeat="error in state.errors.code">{{error}}</div>
				</td>
				<td>
					<span ng-hide="state.editing" ng-dblclick="edit(state)">{{state.country_code}}</span>
					<select ng-show="state.editing" name="country_code" ng-model="state.country_code">
					<option ng-repeat="country in countries" value="{{country.code}}">
						{{country.name}}
					</option>
					</select>
					<div class="btn-danger" ng-show="state.errors.country_code.length" ng-repeat="error in state.errors.country_code">{{error}}</div>
				</td>
				<td>
					<button ng-disabled="!state.editing" class="btn btn-success" ng-click="saveState(state)">Save</button>
					<button ng-disabled="!state.editing" class="btn btn-danger" ng-click="cancelState(state)">Cancel</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script type="text/javascript">

	var countries = <?php echo $countries->toJson();?>;
	
	
	var stateCtrls = angular.module("stateApp.Ctrl",[]);
	stateCtrls.constant("save_url","<?php echo URL::to("admin/states"); ?>");
	stateCtrls.constant("states_url","<?php echo URL::to("admin/states/json-list")?>");
	stateCtrls.controller("stateCtrl",function($scope,$http,$filter,save_url,states_url) {
		$scope.states = null;
		$scope.original = null;
		$scope.countries = countries;

		$scope.newState = {name:"",code:"",country_code:"US"};

		$scope.addState = function(obj) {
			console.log(obj);
			$http.post(save_url, {state:obj}).success(function(data,status,headers,config) {
				if(!data.success) {
					obj.errors = data.messages;
				} else {
					$scope.newState = {name:"",code:"",country_code:"US"};
					$scope.states.push(data.state);
				}
			});
		}
		
		$scope.edit = function(obj) {
			obj.editing=true;
		};

		$scope.saveState = function(obj) {
			$http.patch(save_url+"/"+obj.id,{state:obj}).
			success(function(data, status, headers, config){
				if(!data.success) {
					obj.errors = data.messages;
				} else {
					obj.errors=null;
					
					obj.editing=false;
				}
			}).
			error(function(data, status, headers, config){obj.editing=false;});
			console.log($scope.original);
		};

		$scope.cancelState = function(obj) {
			obj.editing=false;
		}

		$scope.uppercase = function(obj,val) {
		obj[val] = $filter("uppercase")(obj[val]);
		}

		
	
		$scope.init = function() {
			$http.get(states_url).success(function(data,status,headers,config){
				$scope.states = data.states;
				$scope.original = angular.copy($scope.states);
				for (var i =0; i < $scope.states.length;i++) {
					$scope.states[i].editing = false;
				}
			})
		}
		
	});
	
	var stateApp = angular.module("stateApp",['stateApp.Ctrl']);
	

</script>
@stop