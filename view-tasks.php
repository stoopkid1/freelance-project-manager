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
		 	   if(!isset($_GET['project']) && !isset($_GET['id'])) { 
		 			include('templates/tpl-tasks-all.php');
		 	   } elseif(isset($_GET['project']) && !isset($_GET['id'])) { 
		 	   		include('templates/tpl-tasks-project.php');
		 	   } elseif(isset($_GET['id']) && !isset($_GET['project'])) {
		 	   		include('templates/tpl-tasks-view.php');
			   } 
		 ?>					
		  				</div>
		  			</div>
		  		</div>
		  	</div>
		  	
		  </div>	
		</div>

<?php include('footer.php'); ?>