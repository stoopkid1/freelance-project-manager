<?php include('header.php'); ?>
<!-- Sidebar -->
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="view-clients.php"><i class="glyphicon glyphicon-record"></i> Clients</a></li>
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
                    <li><a href="view-history.php"><i class="glyphicon glyphicon-calendar"></i> History</a></li>
                    <li><a href="view-users.php"><i class="glyphicon glyphicon-user"></i> Users</a></li>
                    <li class="current"><a href="settings.php"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
                </ul>
             </div>
		  </div>
<!-- /Sidebar -->

<div class="col-md-10">
			<div class="row">
			 <div class="col-md-12">
			   <h2>Settings</h2>
			 </div>
			</div>
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">Application Settings</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
				  				<h5>Nothing yet</h5>
							</div>
		  				</div>
		  			</div>
		  		</div>
		  		
		  	</div>

		  </div>	
		</div>

<?php include('footer.php'); ?>