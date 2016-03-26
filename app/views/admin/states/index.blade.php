@extends("layouts.admin")
@section("content")
<div class="col-md-12 col-sm-12"></div>
<form method="post">
<input type="text" name="name" placeholder="name" required  />
<input type="text" name="code" placeholder="code" required />
<select name="country_code" required>
	<?php foreach($countries as $country) { 
		echo "<option value='{$country->code}'>{$country->name}</option>";
	}?>
</select>
<button type="submit" class="btn btn-large btn-success">Add</button>
</form>
<div class='col-md-12 col-sm-12' ng-app="stateApp">
	<table class="table" ng-controller="stateCtrl">
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
						{{country.code}}
					</option>
					</select>
					<div class="btn-danger" ng-show="state.errors.country_code.length" ng-repeat="error in state.errors.country_code">{{error}}</div>
				</td>
				<td>
					<button ng-show="state.editing" class="btn btn-success" ng-click="saveStates(state)">Save</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	var states = <?php echo $states->toJson();?>;
	var countries = <?php echo $countries->toJson();?>;
	for (var i =0; i < states.length;i++) {
		states[i].editing = false;
	}
	
	var stateCtrls = angular.module("stateApp.Ctrl",[]);
	stateCtrls.constant("save_url","<?php echo URL::to("admin/states"); ?>");
	stateCtrls.controller("stateCtrl",function($scope,$http,$filter,save_url) {
		$scope.states = states;
		$scope.countries = countries;
	
		
		$scope.edit = function(obj) {
			obj.editing=true;
			//console.log($scope.menus);
		};

		$scope.saveStates = function(obj) {
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
		};

		$scope.uppercase = function(obj,val) {
		obj[val] = $filter("uppercase")(obj[val]);
		}
	
		
	});
	
	var stateApp = angular.module("stateApp",['stateApp.Ctrl']);
	

</script>
@stop