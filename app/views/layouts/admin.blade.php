<!doctype html>
<html>
	<head>
		<?php echo HTML::style('css/bootstrap.min.css'); ?>
		<?php echo HTML::style('css/bootstrap-responsive.min.css'); ?>
		<?php echo Html::style("css/admin.css"); ?>
		<?php echo Html::script("js/angular.min.js"); ?>
		<title><?php echo $title; ?></title>
	</head>
    <body>
    	<h4>Admin page ><?php echo $title; ?></h4>
       <section id="admin-sidebar">
       	<ul>
       		<li><a href="<?php echo URL::to("admin");?>">Dashboard</a></li>
          <li><a href="<?php echo URL::to("admin/restaurants");?>">Restaurants</a></li>
       		<li><a href="<?php echo URL::to("admin/menus"); ?>">Menus</a></li>
          <li><a href="<?php echo URL::to("admin/countries"); ?>">Countries</a></li>
          <li><a href="<?php echo URL::to("admin/states"); ?>">States</a></li>
       	</ul>
       </section>
       <section id="admin-content">
        @yield('content')
    </section>
    </body>
</html>