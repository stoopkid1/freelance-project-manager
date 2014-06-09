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
			 <div class="col-md-12">
			   <h2>Client List</h2>
			 </div>
			</div>
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Current Clients</div>
								
								<div class="panel-options">
									<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add-client"><i class="glyphicon glyphicon-edit"></i> Add Client</button>
								</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<div class="table-responsive">
			  						<table class="table">
						              <thead>
						                <tr>
						                  <th>Company</th>
						                  <th>Owner</th>
						                  <th>Created</th>
						                  <th></th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php $current = $fpm->getCurrentClients(); ?>
						                 <?php foreach($current as $client) { ?>
						                  <tr>
						                   <td><?php print $client['company']; ?></td>
						                   <td><?php print $client['owner']; ?></td>
						                   <td><?php print date('F d, Y', strtotime($client['created'])); ?></td>
						                   <td><a href="view-client.php?id=<?php print $client['id']; ?>" class="btn btn-info btn-xs">View Details</a>
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
			  					<div class="panel-title">Past Clients</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<div class="table-responsive">
			  						<table class="table">
						              <thead>
						                <tr>
						                  <th>Company</th>
						                  <th>Owner</th>
						                  <th>Created</th>
						                  <th></th>
						                </tr>
						              </thead>
						              <tbody>
						                <?php $current = $fpm->getPastClients(); ?>
						                 <?php foreach($current as $client) { ?>
						                  <tr>
						                   <td><?php print $client['company']; ?></td>
						                   <td><?php print $client['owner']; ?></td>
						                   <td><?php print date('F d, Y', strtotime($client['created'])); ?></td>
						                   <td><a href="view-client.php?id=<?php print $client['id']; ?>" class="btn btn-info btn-xs">View Details</a>
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
		
<div class="modal fade" id="add-client">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h4 class="modal-title">Add Client</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="company-create" name="company-create" method="POST" role="form">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Company</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="company-company" placeholder="Company Name" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Owner</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="company-owner" placeholder="Company Owner" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">Website</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="company-website" placeholder="ex: mdloring.com" type="text">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-3 control-label">E-Mail</label>
		    <div class="col-sm-9">
		      <input class="form-control" id="company-email" placeholder="E-Mail Address" type="text">
		    </div>
		  </div>
		  <div class="success">
      		 <span class="success_text"></span>
      	  </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Client</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->		

<?php include('footer.php'); ?>