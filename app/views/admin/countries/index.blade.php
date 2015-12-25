@extends("layouts.admin")
@section("content")
<div class="col-md-12 col-sm-12"></div>
<form method="post">
<?php echo Form::token();?>
<input type="text" name="name" placeholder="name" required />
<input type="text" name="code" placeholder="code" required />
<button type="submit" class="btn btn-large btn-success">Add Country</button>
</form>
<div class='col-md-12 col-sm-12' ng-app="countryApp">

<table class="table" ng-controller="countryCtrl">
	<thead>
		<tr>
			<th>Country</th>
			<th>Code</th>
		</tr>
	</thead>
<tr ng-repeat="country in countries" data-id="{{country.id}}">
	<td>
		<span ng-hide="country.editing" ng-dblclick="edit(country)">{{country.name}}</span>
		<input required ng-show="country.editing" type="text" ng-model="country.name" ng-blur="doneEditing(country)" />
	</td>
	<td>
		<span ng-hide="country.editing" ng-dblclick="edit(country)">{{country.code}}</span>
		<input required ng-show="country.editing" type="text" ng-model="country.code" ng-blur="doneEditing(country)" />
	</td>

</tr>
</table>
</div>
<script type="text/javascript">

var countries = <?php echo $countries->toJson();?>;
for (var i =0; i < countries.length;i++) {
	countries[i].editing = false;
}

var countryCtrls = angular.module("countryApp.Ctrl",[]);
countryCtrls.constant("save_url","<?php echo URL::to("admin/countries"); ?>");
countryCtrls.controller("countryCtrl",function($scope,$http,save_url) {
	$scope.countries = countries;
	$scope.edit = function(obj) {
		obj.editing=true;
		//console.log($scope.menus);
	};
	$scope.doneEditing = function(obj) {
		obj.editing=false;
		$http.patch(save_url+"/"+obj.id,{country:obj}).
		success(function(data, status, headers, config){
			/*if(data.success) {

			}*/
		}).
		error(function(data, status, headers, config){});
	};
});
var countryApp = angular.module("countryApp",['countryApp.Ctrl']);

</script>
@stop