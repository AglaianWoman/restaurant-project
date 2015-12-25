@extends("layouts.admin")
@section("content")
<div class="col-md-12">Create New Restaurant</div>
<from method="post" action="<% URL::to("admin/restaurants/store") %>">
	<?php echo Form::token();?>
	<label>Restaurant Name</label>
	<input type="text" name="name" />
	<label>Address</label>
	<input type="text" name="address" />
	<label>City</label>
	<input type="text" name="city" />
	<label>State</label>
	<select name="state">
	</select>
</form>

@stop