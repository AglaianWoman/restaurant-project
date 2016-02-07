<!doctype html>
<html>
	<head>
		<?php echo HTML::style('css/backend.main.css'); ?>
		<?php //echo HTML::style('css/bootstrap-responsive.min.css'); ?>
		<?php //echo Html::style("css/admin.css"); ?>
		<?php //echo Html::script("js/angular.min.js"); ?>
		<?php echo Html::script("js/backend.main.js"); ?>
		<title><?php echo $title; ?></title>
	</head>
    <body>
    <div class="container-fluid">
    <div class="row">
    	<h4>Admin page ><?php echo $title; ?></h4>
    </div>
    <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3">
    	<section id="admin-sidebar">
       	<ul>
       		<li><a href="<?php echo URL::to("admin");?>">Dashboard</a></li>
          <li><a href="<?php echo URL::to("admin/restaurants");?>">Restaurants</a></li>
       		<li><a href="<?php echo URL::to("admin/menus"); ?>">Menus</a></li>
          <li><a href="<?php echo URL::to("admin/countries"); ?>">Countries</a></li>
          <li><a href="<?php echo URL::to("admin/states"); ?>">States</a></li>
       	</ul>
       </section>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9">
       <section id="admin-content">
        @yield('content')
    </section>
    </div>
    
    	
    	</div>
       
    </div>
    </body>
</html>