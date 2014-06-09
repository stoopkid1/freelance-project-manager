<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

		<div class="col-md-10">
			<div class="row">
			 <?php 
				if(isset($_GET['id']) && is_numeric($_GET['id'])) {
					$client = $_GET['id'];
					 $details = $fpm->getClient($client);				
			 ?>
			 <div class="col-md-12">
			   <h2><?php print $details['company'] . " Details"; ?></h2>
			 </div>
			</div>
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Client Details</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  			
				  			<div class="table-responsive">
			  						<table class="table">
						              <thead>
						               <tbody>
						                <tr>
						                 <td><strong>Company</strong></td>
						                 <td><?php print $details['company']; ?></td>
						                </tr>
						                <tr>
						                 <td><strong>Owner</strong></td>
						                 <td><?php print $details['owner']; ?></td>
						                </tr>
						                <tr>
						                 <td><strong>Website</strong></td>
						                 <td><?php print $details['website']; ?></td>
						                </tr>
						                <tr>
						                 <td><strong>Created</strong></td>
						                 <td><?php print $details['created']; ?></td>
						                </tr>
						                <tr>
						                 <td><strong>Status</strong></td>
						                 <td><?php print ($details['status'] == 1 ? 'Active' : 'Inactive'); ?></td>
						                </tr>  
						              </tbody>
						            </table>
  								</div>
		  				
							</div>
		  				</div>
		  			</div>
		  		</div>

		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Client Projects</div>
			  					
			  					<div class="panel-options">
									<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-edit"></i></a>
								</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<div class="table-responsive">
			  						<table class="table">
						              <thead>
						                <tr>
						                  <th>Project</th>
						                  <th>Type</th>
						                  <th>Created</th>
						                  <th></th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php $projects = $fpm->getClientProjects($client); ?>
						                 <?php foreach($projects as $project) { ?>
						                  <tr>
						                   <td><?php print $project['project']; ?></td>
						                   <td><?php print $project['type']; ?></td>
						                   <td><?php print date('F d, Y', strtotime($project['created'])); ?></td>
						                   <td><a href="view-project.php?id=<?php print $project['id']; ?>" class="btn btn-info btn-xs">Project Details</a>
						                  </tr>
						                 <?php } ?>
						              </tbody>
						            </table>
  								</div>
							</div>
		  				</div>
		  			<?php } else { ?>
		  				<h3>Sorry, no Client was selected</h3>
		  			<?php } ?>
		  			</div>
		  		</div>
		  	</div>
		  	
		  </div>	
		</div>

<?php include('footer.php'); ?>