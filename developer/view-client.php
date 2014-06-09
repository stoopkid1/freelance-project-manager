<?php include('header.php'); ?>
<!-- Sidebar -->
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li class="current"><a href="view-clients.php"><i class="glyphicon glyphicon-record"></i> Clients</a></li>
                    <li><a href="view-projects.php"><i class="glyphicon glyphicon-fire"></i> Projects</a></li>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-tasks"></i> Tasks
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="view-tasks-user.php">My Tasks</a></li>
                            <li><a href="view-tasks.php">All</a></li>
                        </ul>
                    </li>
                    <li><a href="view-reminders.php"><i class="glyphicon glyphicon-pushpin"></i> Reminders</a></li>
                    <li><a href="view-history.php"><i class="glyphicon glyphicon-calendar"></i> History</a></li>
                    <li><a href="view-users.php"><i class="glyphicon glyphicon-user"></i> Users</a></li>
                    <li><a href="settings.php"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
                </ul>
             </div>
		  </div>
<!-- /Sidebar -->

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
						                 <td>
						                 	<a href="<?php print $details['website']; ?>" target="_blank">
						                 		<?php print $details['website']; ?>
						                 	</a>
						                 </td>
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