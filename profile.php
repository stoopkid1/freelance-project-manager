<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="content-box-header">
			  			<div class="panel-title">Personal Details</div>
				  	</div>
				  	<div class="content-box-large box-with-header">
				  		<form class="form-horizontal" role="form">
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-3 control-label">First Name</label>
						    <div class="col-sm-9">
						      <input class="form-control" id="profile-first-name" placeholder="First Name" type="text">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-3 control-label">Last Name</label>
						    <div class="col-sm-9">
						      <input class="form-control" id="profile-last-name" placeholder="Last Name" type="text">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-3 control-label">Phone Number</label>
						    <div class="col-sm-9">
						      <input class="form-control" id="profile-phone-number" placeholder="ex: 123-456-7890" type="phone">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-3 control-label"> 	E-Mail</label>
						    <div class="col-sm-9">
						      <input class="form-control" id="profile-first-name" placeholder="E-Mail Address" type="text">
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      <button type="submit" class="btn btn-primary">Update Details</button>
						    </div>
						  </div>
				  		</form>
					</div>
					<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Update Password</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<form class="form-horizontal" role="form">
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-3 control-label"> 	Password</label>
								    <div class="col-sm-9">
								      <input class="form-control" type="password" id="update-password" placeholder="Password">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-3 control-label"> 	Confirm</label>
								    <div class="col-sm-9">
								      <input class="form-control" type="password" id="update-confirm" placeholder="Password">
								    </div>
								  </div>
								  <div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <button type="submit" class="btn btn-primary">Update Password</button>
								    </div>
								  </div>
						  		</form>
							</div>
		  				</div>
		  			</div>
		  		</div>

		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Total Work Details</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<form class="form-horizontal" role="form">
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-4 control-label"> 	Clients</label>
								    <div class="col-sm-3">
								      <input disabled class="form-control" value="<?php print $fpm->getTotalClients(); ?>" type="text">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-4 control-label"> 	Projects</label>
								    <div class="col-sm-3">
								      <input disabled class="form-control" value="<?php print count($fpm->getProjects()); ?>" type="text">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-4 control-label"> 	Active Tasks</label>
								    <div class="col-sm-3">
								      <input disabled class="form-control" value="<?php print count($fpm->getUserActiveTasks($fpm_username)); ?>" type="text">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-4 control-label"> 	Completed Tasks</label>
								    <div class="col-sm-3">
								      <input disabled class="form-control" value="<?php print count($fpm->getUserCompletedTasks($fpm_username)); ?>" type="text">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-4 control-label"> 	Total Tasks</label>
								    <div class="col-sm-3">
								      <input disabled class="form-control" value="<?php print count($fpm->getUserActiveTasks($fpm_username)) + count($fpm->getUserCompletedTasks($fpm_username)); ?>" type="text">
								    </div>
								  </div>
						  		</form>
							</div>
		  				</div>
		  			</div>
		  		</div>
		  	</div>

		  </div>	
		</div>

<?php include('footer.php'); ?>