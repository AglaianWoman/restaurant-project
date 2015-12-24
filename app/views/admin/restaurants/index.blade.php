@extends("layouts.admin")
@section("content")
<div class="col-md-12 col-sm-12"></div>

<a href="<% URL::to("admin/restaurants/create") %>" class="btn btn-large btn-success">Add New Restaurant</a>

<div class='col-md-12 col-sm-12' ng-app="menuApp">

<table class="table" ng-controller="restaurantCtrl">
	<thead>
		<tr>
			<th>Restaurant Name</th>
			<th>Address</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="restaurant in restaurant" data-id="{{menu.id}}">
			<td>
				
			</td>
			<td>

			</td>
			<td>

			</td>
		</tr>
	</tbody>
</table>
</div>
<script type="text/javascript">
var restaurants = <?php echo $restaurants->toJson();?>;
var restaurantCtrls = angular.module("restaurantApp.Ctrl",[]);
restaurantCtrls.controller("restaurantCtrl",function($scope,$http,save_url) {
	$scope.restaurants = $restaurants;
	});
</script>
@stop