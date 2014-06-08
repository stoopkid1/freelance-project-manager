<?php session_start();
	include('lib/class.db.php');
	include('lib/class.fpm.php');
	
	$fpm = new fpm();
	
	if(!$fpm->link) {
		header("Location: install.php");
	}
	
	if(isset($_SESSION['fpm_username'])) {
		$fpm_username = $_SESSION['fpm_username'];
		 $fpm_username_details = $fpm->getUser($fpm_username);
	} else {
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Freelance Project Manager v1.0 - Organize Tasks, Complete Projects</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/fpm.css" rel="stylesheet">
    <!-- jQuery UI -->
    <link href="css/fpm-ui/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <!-- Google Font - Roboto -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,900' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">Freelance Project Manager</a></h1>
	              </div>
	           </div>
	           <div class="col-md-3">
	              <div class="row">
	                <div class="col-lg-12">
	                  <div class="input-group form">
	                       <input type="text" class="form-control" placeholder="Search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
	                  </div>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-4">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php print $fpm_username; ?> <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="profile.php">Profile</a></li>
	                          <li><a href="logout.php">Logout</a></li>
	                        </ul>
	                      </li>
	                      <li class="show_date"><?php print date('F d, Y', strtotime('now')); ?></li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>
	<div class="page-content">
    	<div class="row">