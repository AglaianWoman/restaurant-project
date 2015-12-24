@extends("layouts.admin")
@section("content")
<div class="col-md-12 col-sm-12"></div>
<form method="post">
<input type="text" name="name" />
<button type="submit" class="btn btn-large btn-success">Add</button>
</form>
<div class='col-md-12 col-sm-12' ng-app="menuApp">

<table class="table" ng-controller="menuCtrl">
<tr ng-repeat="menu in menus" data-id="{{menu.id}}">
	<td>
		<span ng-hide="menu.editing" ng-dblclick="edit(menu)">{{menu.name}}</span>
		<input ng-show="menu.editing" type="text" ng-model="menu.name" ng-blur="doneEditing(menu)" />
	</td>

</tr>
</table>
</div>
<script type="text/javascript">
var menus = <?php echo $menus->toJson();?>;
for (var i =0; i < menus.length;i++) {
	menus[i].editing = false;
}
console.log(menus);
var menuCtrls = angular.module("menuApp.Ctrl",[]);
menuCtrls.constant("save_url","<?php echo URL::to("admin/menus"); ?>");
menuCtrls.controller("menuCtrl",function($scope,$http,save_url) {
	$scope.menus = menus;
	$scope.edit = function(obj) {
		obj.editing=true;
		//console.log($scope.menus);
	};
	$scope.doneEditing = function(obj) {
		obj.editing=false;
		$http.patch(save_url+"/"+obj.id,{menu:obj}).
		success(function(data, status, headers, config){
			/*if(data.success) {

			}*/
		}).
		error(function(data, status, headers, config){});
	};
});
var menuApp = angular.module("menuApp",['menuApp.Ctrl']);

</script>
@stop