<?php include('header.php'); ?>
<?php global $fpm_username, $fpm_user_id; ?>
<!-- Sidebar -->
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="view-clients.php"><i class="glyphicon glyphicon-record"></i> Clients</a></li>
                    <li><a href="view-projects.php"><i class="glyphicon glyphicon-fire"></i> Projects</a></li>
                    <li class="submenu current">
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
					$task = $_GET['id'];
					 $details = $fpm->getTask($task);
					 if( $details['assignee'] != $fpm_username ) {
					 	echo 'Sorry, you do not have access to this task';
					 	return;
					 }
					 $project = $fpm->getProjectName($details['project']);
					 $client  = $fpm->getClient($details['company']);
			 ?>
			 <div class="col-md-12">
			   <h2><?php print $details['task'] . " Details"; ?></h2>
			 </div>
			</div>
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Task Details</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  			
				  			<div class="table-responsive">
				  					<input type="hidden" id="task-id" name="task-id" value="<?php print $task; ?>" />
			  						<table class="table">
						              <thead>
						               <tbody>
						                <tr>
						                 <td><strong>Company</strong></td>
						                 <td><?php print $client['company']; ?></td>
						                </tr>
						                <tr>
						                 <td><strong>Project</strong></td>
						                 <td>
						                 	<a href="view-project.php?id=<?php print $details['project']; ?>">
						                 		<?php print $project; ?>
						                 	</a>
						                 </td>
						                </tr>
						                <tr>
						                 <td><strong>Assignee</strong></td>
						                 <td><?php print $details['assignee']; ?></td>
						                </tr>
						                <tr>
						                 <td><strong>Priority</strong></td>
						                 <td><?php print $details['priority']; ?></td>
						                </tr>
						                <tr>
						                 <td><strong>Description</strong></td>
						                 <td>
						                 	<textarea disabled id="task-edit-description" class="form-control"><?php print $details['description']; ?></textarea>
						                 	<br/>
						                 	<button id="task-edit-description-btn" type="button" class="btn btn-info btn-xs">Edit Description</button>
						                 	<button id="task-save-description-btn" type="button" class="btn btn-primary btn-xs">Save Changes</button>
						                 	<button id="task-cancel-description-btn" type="button" class="btn btn-warning btn-xs">Cancel</button>
						                 </td>
						                </tr>
						                <tr>
						                 <td><strong>Percent</strong></td>
						                 <td>
						                 	<div class="progress push-down">
						  					 <div class="progress-bar" role="progressbar" aria-valuenow="<?php print $details['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php print $details['percent']; ?>%;">
						    				  <?php print $details['percent']; ?>%<br/>
						  					 </div>
											</div>
											<button id="task-edit-progress-btn" type="button" class="btn btn-info btn-xs">Edit Progress</button>
											<div class="col-md-3">
												<input disabled type="text" class="form-control" id="task-update-progress" />
											</div>
						                 	<button id="task-save-progress-btn" type="button" class="btn btn-primary btn-xs">Save Changes</button>
						                 	<button id="task-cancel-progress-btn" type="button" class="btn btn-warning btn-xs">Cancel</button>
						                 </td>
						                </tr>
						                <tr>
						                 <td><strong>Created</strong></td>
						                 <td><?php print $details['created']; ?></td>
						                </tr>
						                <tr>
						                 <td><strong>Status</strong></td>
						                 <td>
						                 	<?php if($details['status'] == 1) { ?>
						                 		<span class="text-success">Active</span>
						                 		<button id="task-mark-completed-btn" type="button" class="btn btn-success btn-xs pull-right">Mark as Completed</button>
						                 	<?php } else { ?>
						                 		<span class="text-danger">Completed</span>
						                 		<button id="task-mark-active-btn" type="button" class="btn btn-primary btn-xs pull-right">Change to Active</button>
						                 	<?php } ?>
						                 </td>
						                </tr>  
						              </tbody>
						            </table>
						            <div class="success">
						             <span class="success_text"></span>
						            </div>
  								</div>
		  				
							</div>
		  				</div>
		  			</div>
		  			
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Add Task Reminder</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  			<form id="task-add-reminder" class="form-inline" role="form">
				  			 <input type="hidden" id="task-task" name="task-task" value="<?php print $task; ?>" />
				  			  <div class="form-group">
            					<textarea class="tiny_mce" id="task-reminder"></textarea><br/>
            				  </div>
            				  <div class="form-group">
							    <div class="col-sm-12">
							      <button type="submit" class="btn btn-primary">Add Task Reminder</button>
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
			  					<div class="panel-title">Add Task Note</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  			<form id="task-add-note" class="form-inline" role="form">
				  			 <input type="hidden" id="task-task" name="task-task" value="<?php print $task; ?>" />
				  			  <div class="form-group">
            					<textarea class="tiny_mce" id="task-note"></textarea><br/>
            				  </div>
            				  <div class="form-group">
							    <div class="col-sm-12">
							      <button type="submit" class="btn btn-primary">Add Task Note</button>
							    </div>
							  </div>
							 </form>
							</div>
		  				</div>
		  			</div>
		  			
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Task Notes</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<?php print $details['notes']; ?>
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