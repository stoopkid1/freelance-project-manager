<?php include('header.php'); ?>
<!-- Sidebar -->
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li class="current"><a href="view-projects.php"><i class="glyphicon glyphicon-fire"></i> Projects</a></li>
                    <li><a href="view-tasks.php"><i class="glyphicon glyphicon-tasks"></i> Tasks</a></li>
                    <li><a href="view-history.php"><i class="glyphicon glyphicon-calendar"></i> History</a></li>
                </ul>
             </div>
		  </div>
<!-- /Sidebar -->

		<div class="col-md-10">
			<div class="row">
			 <?php 
				if(isset($_GET['id']) && is_numeric($_GET['id'])) {
					$project = $_GET['id'];
					 $details = $fpm->getProject($project);
					 $client_id = $fpm->getClientID($details['company']);
			 ?>
			 <div class="col-md-12">
			   <h2><?php print $details['project'] . " Details"; ?></h2>
			 </div>
			</div>
		  	<div class="row">
		  	 <?php if($details['cid'] != $fpm_company_id) { ?>
		  		<h3>Sorry, Project is not under <em><?php print $fpm_company; ?></em></h3>
		  	<?php } else { ?>
		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Project Details</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  			
				  			<div class="table-responsive">
				  					<input type="hidden" id="project-id" name="project-id" value="<?php print $project; ?>" />
			  						<table class="table">
						              <thead>
						               <tbody>
						                <tr>
						                 <td><strong>Company</strong></td>
						                 <td><?php print $details['company']; ?></td>
						                </tr>
						                <tr>
						                 <td><strong>Description</strong></td>
						                 <td>
						                 	<textarea disabled id="edit-description" class="form-control"><?php print $details['description']; ?></textarea>
						                 	<br/>
						                 	<button id="edit-description-btn" type="button" class="btn btn-info btn-xs">Edit Description</button>
						                 	<button id="save-description-btn" type="button" class="btn btn-primary btn-xs">Save Changes</button>
						                 	<button id="cancel-description-btn" type="button" class="btn btn-warning btn-xs">Cancel</button>
						                 </td>
						                </tr>
						                <tr>
						                 <td><strong>Type</strong></td>
						                 <td><?php print $details['type']; ?></td>
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
						                 		<button id="mark-completed-btn" type="button" class="btn btn-success btn-xs pull-right">Change to Completed</button>
						                 	<?php } else { ?>
						                 		<span class="text-danger">Completed</span>
						                 		<button id="mark-active-btn" type="button" class="btn btn-primary btn-xs pull-right">Change to Active</button>
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
		  		</div>

		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Project Tasks</div>
			  					
			  					<div class="panel-options">
									<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add-task"><i class="glyphicon glyphicon-edit"></i> Add Task</button>
								</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<div class="table-responsive">
			  						<table class="table">
						              <thead>
						                <tr>
						                  <th>Task</th>
						                  <th>Assignee</th>
						                  <th>Status</th>
						                  <th></th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php $tasks = $fpm->getProjectTasks($project); ?>
						                 <?php foreach($tasks as $task) { ?>
						                  <tr>
						                   <td><?php print $task['task']; ?></td>
						                   <td><?php print $task['assignee']; ?></td>
						                   <td><?php print ($task['status'] == 100 ? '<span class="text-success">Completed</span>' : '<span class="text-primary">' . $task['percent'] . '%</span>'); ?></td>
						                   <td><a href="view-task.php?id=<?php print $task['id']; ?>" class="btn btn-info btn-xs">Details</a>
						                  </tr>
						                 <?php } ?>
						              </tbody>
						            </table>
  								</div>
							</div>
		  				</div>
		  				<?php } ?>
		  			<?php } else { ?>
		  				<h3>Sorry, no Client was selected</h3>
		  			<?php } ?>
		  			</div>
		  		</div>
		  		
		  	</div>
		  	
		  </div>	
		</div>

<div class="modal fade" id="add-task">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h4 class="modal-title">Add Project Task</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="task-create" name="task-create" method="POST" role="form">
         <input type="hidden" id="task-company" name="task-company" value="<?php print $client_id; ?>" />
         <input type="hidden" id="task-project" name="task-project" value="<?php print $project; ?>" />
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Task</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="task-task" placeholder="Task Name" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Description</label>
		    <div class="col-sm-9">
		      <textarea class="form-control" id="task-description" placeholder="Task Description"></textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Assignee</label>
		    <div class="col-sm-9">
		      <select class="form-control" id="task-assignee">
		      		<option value=""></option>
		      	<?php $freelancers = $fpm->getFreelancers(); ?>
		      	 <?php foreach($freelancers as $freelancer) { ?>
		      	 	<option value="<?php print $freelancer['username']; ?>"><?php print $freelancer['first_name'] . " " . $freelancer['last_name']; ?></option>
		      	 <?php } ?>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Priority</label>
		    <div class="col-sm-9">
		      <select class="form-control" id="task-priority">
		      		<option value=""></option>
		      		<option value="Low">Low</option>
		      		<option value="Medium">Medium</option>
		      		<option value="Urgent">Urgent</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Due Date</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="task-due-date" placeholder="Choose Date" type="text">
		    </div>
		  </div>
		  <div class="success">
      		 <span class="success_text"></span>
      	  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Task</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->		
<?php include('footer.php'); ?>