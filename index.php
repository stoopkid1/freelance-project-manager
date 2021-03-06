<?php session_start();
	if(isset($_SESSION['fpm_username'])) {
		header("Location: developer/index.php");
	} 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Freelance Project Manager - Organize Tasks, Complete Projects</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="assets/css/compiled.fpm.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,900' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">Freelance Project Manager <sup>beta 1.0</sup></a> 
	                 	 <a href="http://www.mdloring.com" target="_blank"><span class="built-by">built by michael loring</span></a>
	                 </h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			              <form id="fpmLogin" name="fpmLogin" method="POST">
			                <input class="form-control" type="text" id="login-username" placeholder="E-mail address">
			                <input class="form-control" type="password" id="login-password" placeholder="Password">
			                <div class="login_success">
			               		<span class="login_success_text"></span>
			             	</div>
			                <div class="action">
			                    <button type="submit" class="btn btn-primary signup">Login</button>
			                </div>    
			              </form>
			            </div>
			        </div>

			        <div class="already">
			            <p>Are you a <em>Developer</em>?</p>
			            <a href="signup.php">Sign Up</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>
	

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="developer/js/fpm.js"></script>
  </body>
</html>