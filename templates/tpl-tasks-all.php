<div class="content-box-header">
		<div class="panel-title">All Tasks</div>
	
	<div class="panel-options">
		<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-edit"></i></a>
	</div>
	</div>
	<div class="content-box-large box-with-header">
		<div id="rootwizard">
	<div class="navbar">
	  <div class="navbar-inner">
	    <div class="container">
	<ul class="nav nav-pills">
	  	<li class="active"><a href="#active-tab" data-toggle="tab">Active</a></li>
		<li class=""><a href="#completed-tab" data-toggle="tab">Completed</a></li>
	</ul>
	 </div>
	  </div>
	</div>
	<div class="tab-content">
	    <div class="tab-pane active" id="active-tab">
	     <?php $all_tasks = $fpm->getAllActiveTasks(); ?>
	      <div class="table-responsive">
				<table class="table">
              <thead>
                <tr>
                  <th>Project</th>
                  <th>Assignee</th>
                  <th>Created</th>
                  <th>Completion %</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach($all_tasks as $task) { ?>
                  <tr>
                   <td><em><a href="view-tasks.php?project=<?php print $task['project']; ?>"><?php print $task['pname']; ?></a></em></td>
                   <td <?php print ($task['assignee'] == $_SESSION['fpm_user'] ? 'class="text-success"' : ''); ?>><?php print $task['assignee']; ?></td>
                   <td><?php print date('F d, Y', strtotime($task['created'])); ?></td>
                   <td>
                   	<div class="progress">
  					 <div class="progress-bar" role="progressbar" aria-valuenow="<?php print $task['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php print $task['percent']; ?>%;">
    				  <?php print $task['percent']; ?>%
  					 </div>
					</div>
				   </td>
                   <td><a href="view-task.php?id=<?php print $task['id']; ?>" class="btn btn-info btn-xs">View Details</a>
                  </tr>
                 <?php } ?>
              </tbody>
            </table>
		 </div>
	    </div>
	    <div class="tab-pane" id="completed-tab">
	      <?php $completed_tasks = $fpm->getAllCompletedTasks(); ?>
	      <div class="table-responsive">
				<table class="table">
              <thead>
                <tr>
                  <th>Project</th>
                  <th>Assignee</th>
                  <th>Created</th>
                  <th>Completed</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach($completed_tasks as $c_task) { ?>
                  <tr>
                   <td><em><a href="view-tasks.php?project=<?php print $c_task['project']; ?>"><?php print $c_task['pname']; ?></a></em></td>
                   <td <?php print ($c_task['assignee'] == $_SESSION['fpm_user'] ? 'class="text-success"' : ''); ?>><?php print $c_task['assignee']; ?></td>
                   <td><?php print date('F d, Y', strtotime($c_task['created'])); ?></td>
                   <td><?php print date('F d, Y', strtotime($c_task['completeDate'])); ?></td>
                   <td><a href="view-task.php?id=<?php print $c_task['id']; ?>" class="btn btn-info btn-xs">View Details</a>
                  </tr>
                 <?php } ?>
              </tbody>
            </table>
			  </div>
	    </div>
	</div>	
  </div>
</div>