<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="col-md-10">
			<div class="row">
			 <div class="col-md-12">
			   <h2>Client List</h2>
			 </div>
			</div>
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Current Projects</div>
								
								<div class="panel-options">
									<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-edit"></i></a>
								</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<div class="table-responsive">
			  						<table class="table">
						              <thead>
						                <tr>
						                  <th>Company</th>
						                  <th>Project</th>
						                  <th>Created</th>
						                  <th></th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php $projects = $fpm->getActiveProjects(); ?>
						                 <?php foreach($projects as $project) { ?>
						                  <tr>
						                   <td><?php print $project['company']; ?></td>
						                   <td><?php print $project['project']; ?></td>
						                   <td><?php print date('F d, Y', strtotime($project['created'])); ?></td>
						                   <td><a href="view-project.php?id=<?php print $project['id']; ?>" class="btn btn-info btn-xs">View Details</a>
						                  </tr>
						                 <?php } ?>
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
			  					<div class="panel-title">Past Projects</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<div class="table-responsive">
			  						<table class="table">
						              <thead>
						                <tr>
						                  <th>Company</th>
						                  <th>Project</th>
						                  <th>Created</th>
						                  <th></th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php $projects = $fpm->getPastProjects(); ?>
						                 <?php foreach($projects as $project) { ?>
						                  <tr>
						                   <td><?php print $project['company']; ?></td>
						                   <td><?php print $project['project']; ?></td>
						                   <td><?php print date('F d, Y', strtotime($project['created'])); ?></td>
						                   <td><a href="view-project.php?id=<?php print $project['id']; ?>" class="btn btn-info btn-xs">View Details</a>
						                  </tr>
						                 <?php } ?>
						              </tbody>
						            </table>
  								</div>
							</div>
		  				</div>
		  			</div>
		  		</div>
		  	</div>
		  	
		  </div>	
		</div>

<?php include('footer.php'); ?>