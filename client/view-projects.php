<?php include('header.php'); ?>
<!-- Sidebar -->
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="view-projects.php"><i class="glyphicon glyphicon-fire"></i> Projects</a></li>
                    <li><a href="view-tasks.php"><i class="glyphicon glyphicon-tasks"></i> Tasks</a></li>
                    <li><a href="view-history.php"><i class="glyphicon glyphicon-calendar"></i> History</a></li>
                </ul>
             </div>
		  </div>
<!-- /Sidebar -->

<div class="col-md-10">
			<div class="row">
			 <div class="col-md-12">
			   <h2><?php print $fpm_company; ?> Project List</h2>
			 </div>
			</div>
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Current Projects</div>
								
								<div class="panel-options">
									<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add-project"><i class="glyphicon glyphicon-edit"></i> Create Project</button>
								</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<div class="table-responsive">
			  						<table class="table">
						              <thead>
						                <tr>
						                  <th>Project</th>
						                  <th>Created</th>
						                  <th></th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php $projects = $fpm->getActiveProjects($fpm_company_id); ?>
						                 <?php foreach($projects as $project) { ?>
						                  <tr>
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
						                  <th>Project</th>
						                  <th>Created</th>
						                  <th></th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php $projects = $fpm->getPastProjects(); ?>
						                 <?php foreach($projects as $project) { ?>
						                  <tr>
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

<div class="modal fade" id="add-project">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h4 class="modal-title">Create New Project</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="project-create" name="add-project" method="POST" role="form">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Project</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="project-name" placeholder="Project Name" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Description</label>
		    <div class="col-sm-9">
		      <textarea class="form-control" id="project-description" placeholder="Task Description"></textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Type</label>
		    <div class="col-sm-9">
		      <select class="form-control" id="project-type">
		      		<option value=""></option>
		      		<option value="website">Web Site</option>
		      		<option value="application">Application</option>
		      		<option value="other">Other</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Company</label>
		    <div class="col-sm-9">
		      <select class="form-control" id="project-company">
		      		<option value="<?php print $fpm_company_id; ?>"><?php print $fpm_company; ?></option>
		      </select>
		    </div>
		  </div>
		  <div class="success">
      		 <span class="success_text"></span>
      	  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Create Project</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	
<?php include('footer.php'); ?>