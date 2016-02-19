<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php echo HTML::style('css/backend.main.css'); ?>
		<?php //echo HTML::style('css/bootstrap-responsive.min.css'); ?>
		<?php //echo Html::style("css/admin.css"); ?>
		<?php //echo Html::script("js/angular.min.js"); ?>
		<?php echo Html::script("js/backend.main.js"); ?>
		<title>Login</title>
	</head>
    <body>
    <div class="container-fluid">
    <div class="row">
    	<h4>Login</h4>
    </div>
    <div class="row">
   
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
       <section id="admin-content">
        	@yield('content')
    	</section>
    </div>
    
    	
    	</div>
       
    </div>
    </body>
</html>