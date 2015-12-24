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
			
		</tr>
	</thead>
<tr ng-repeat="state in states" data-id="{{state.id}}">
	<td>
		<span ng-hide="state.editing" ng-dblclick="edit(state)">{{state.name}}</span>
		<input ng-show="state.editing" type="text" ng-model="state.name" ng-blur="doneEditing(state)" />
	</td>
	<td>
		<span ng-hide="state.editing" ng-dblclick="edit(state)">{{state.code}}</span>
		<input ng-show="state.editing" type="text" ng-model="state.code" ng-blur="doneEditing(state)" />
	</td>
	<td>
		<span ng-hide="state.editing" ng-dblclick="edit(state)">{{state.country_code}}</span>
		<select ng-show="state.editing" name="country_code" ng-options="country.country_code for country in countries">

		</select>
	</td>

</tr>
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
stateCtrls.controller("stateCtrl",function($scope,$http,save_url) {
	$scope.states = states;
	$scope.countries = countries;
	$scope.edit = function(obj) {
		obj.editing=true;
		//console.log($scope.menus);
	};
	$scope.doneEditing = function(obj) {
		obj.editing=false;
		$http.patch(save_url+"/"+obj.id,{state:obj}).
		success(function(data, status, headers, config){
			/*if(data.success) {

			}*/
		}).
		error(function(data, status, headers, config){});
	};
});
var stateApp = angular.module("stateApp",['stateApp.Ctrl']);

</script>
@stop