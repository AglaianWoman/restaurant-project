@extends("layouts.admin")
@section("content")
<?php ?>
<!-- 
TODO: 
pagination.
everything should stay in one page. no refreshes.
 -->

<div class='col-md-12 col-sm-12' ng-app="stateApp">
<div ng-controller="stateCtrl">
<form method="post">

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
<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
<input ng-model="searchText" placeholder="Search..." />
	<table class="table" data-ng-init="init()">
		<thead>
			<tr>
				<th ng-click="sortBy='name';sortReverse=!sortReverse">State/Province
				<span ng-show="sortBy=='name' && !sortReverse" class="fa fa-caret-down"></span>
				<span ng-show="sortBy=='name' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th ng-click="sortBy='code';sortReverse=!sortReverse">Code
				<span ng-show="sortBy=='code' && !sortReverse" class="fa fa-caret-down"></span>
				<span ng-show="sortBy=='code' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th ng-click="sortBy='country_code';sortReverse=!sortReverse">Country
				<span ng-show="sortBy=='country_code' && !sortReverse" class="fa fa-caret-down"></span>
				<span ng-show="sortBy=='country_code' && sortReverse" class="fa fa-caret-up"></span>
				</th>
				<th>Actions</th>
			</tr>
		</thead>
	
		<tbody>
			<tr ng-repeat="state in states | orderBy:sortBy:sortReverse | filter:searchText" data-id="{{state.id}}">
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
	</div>
</div>

<script type="text/javascript">

	var countries = <?php echo $countries->toJson();?>;
	
	
	var stateCtrls = angular.module("stateApp.Ctrl",[]);
	stateCtrls.constant("CSRF_TOKEN","<?php echo csrf_token(); ?>");
	stateCtrls.constant("save_url","<?php echo URL::to("admin/states"); ?>");
	stateCtrls.constant("states_url","<?php echo URL::to("admin/states/json-list")?>");
	/*stateCtrls.directive("stateData",function() {
			return {
			    restrict: 'C',
			 		scope: {
						state: "=info",
					
				 	},
			    template: jQuery("#stateTemplate").html(),
			        
		        link: function(scope, elm, attrs) {
			        scope.mycopy = null;      
		        	scope.edit = function(obj) {
			        	scope.mycopy = angular.copy(obj);
		    			obj.editing=true;
		    			
		    		};

		    		scope.cancelState = function(obj) {
			    		console.log(scope.mycopy);
			    		obj = angular.copy(scope.mycopy);
		    			obj.editing=false;
		    			console.log(obj);
		    		
		    		};
		    		
		        }
			  };
	});*/

	stateCtrls.controller("stateCtrl",
			function($scope,$http,$filter,save_url,states_url,CSRF_TOKEN) {
		$scope.sortBy = 'name';
		$scope.sortReverse = false;
		$scope.states = null;
		$scope.original = {};
		$scope.countries = countries;
		$scope.searchText   = '';

		$scope.newState = {name:"",code:"",country_code:"US"};

		$scope.addState = function(obj) {
			console.log(obj);
			var data = {state:obj};
			data['_token'] = CSRF_TOKEN;
			$http.post(save_url, data).success(function(data,status,headers,config) {
				if(!data.success) {
					obj.errors = data.messages;
				} else {
					$scope.newState = {name:"",code:"",country_code:"US"};
					console.log($scope.states);
					$scope.states.push(data.state);
				}
			});
		}
		
		$scope.edit = function(obj) {
			obj.editing=true;
			$scope.original[obj.id] = angular.copy(obj);
		};

		$scope.saveState = function(obj) {
			var id = obj.id;
			var data = {state:obj};
			data["_token"] = CSRF_TOKEN;
			$http.patch(save_url+"/"+obj.id,data).
			success(function(data, status, headers, config){
				if(!data.success) {
					obj.errors = data.messages;
				} else {
					obj.errors=null;
					
					obj.editing=false;
				}
			}).
			error(function(data, status, headers, config){
				angular.forEach($scope.original[id],function(value,key) {
					obj[key] = value;
				});
				obj.editing=false;
			});
			delete $scope.original[id];
			console.log($scope.original);
		};

		$scope.cancelState = function(obj) {
			var id = obj.id;
		
			angular.forEach($scope.original[id],function(value,key) {
				obj[key] = value;
			});

			obj.editing=false;

			delete $scope.original[id];
		
		}

		$scope.uppercase = function(obj,val) {
			obj[val] = $filter("uppercase")(obj[val]);
		}

		
	
		$scope.init = function() {
			$http.get(states_url).success(function(data,status,headers,config){
				$scope.states = data.states;
				for (var i =0; i < data.states.length;i++) {
					$scope.states[i].editing = false;
				}

			});

			
		}
		
	});
	
	var stateApp = angular.module("stateApp",['stateApp.Ctrl']);
	

</script>
@stop