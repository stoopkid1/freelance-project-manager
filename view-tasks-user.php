<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10">
			<div class="row">
			 <div class="col-md-12">
			   <h2>Tasks</h2>
			 </div>
			</div>
		  	<div class="row">
		  		<div class="col-md-12">
		  			<div class="row">
		  				<div class="col-md-12">
		 <?php 
		 	   if(isset($fpm_username)) { 
		 			include('templates/tpl-tasks-user.php');
		 	   } else {
		 	   		print '<h3>You are not logged in.</h3>';
		 	   }
		 ?>					
		  				</div>
		  			</div>
		  		</div>
		  	</div>
		  	
		  </div>	
		</div>

<?php include('footer.php'); ?>