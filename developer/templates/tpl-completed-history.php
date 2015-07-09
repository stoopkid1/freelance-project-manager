<div class="col-md-4">
<div class="content-box-header">
  <div class="panel-title">Completed Projects</div>
</div>
	<div class="content-box-large box-with-header">
	     <?php $all_projects = $fpm->getPastProjects(); ?>
	      <div class="table-responsive">
			<table class="table">
              <thead>
                <tr>
                  <th>Project</th>
                  <th>Company</th>
                  <th>Type</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach($all_projects as $project) { $company = $fpm->getCompanyName($project['cid']); ?>
                  <tr>
                   <td><em><a href="view-project.php?id=<?php print $project['id']; ?>"><?php print $project['project']; ?></a></em></td>
                   <td><?php print $company ?></td>
                   <td><?php print $project['type']; ?></td>
                   <td><a href="view-project.php?id=<?php print $project['id']; ?>" class="btn btn-info btn-xs">View Details</a>
                  </tr>
                 <?php } ?>
              </tbody>
            </table>
		 </div>
</div>	    
</div>
<div class="col-md-8">
<div class="content-box-header">
  <div class="panel-title">Completed Tasks</div>
</div>
	<div class="content-box-large box-with-header">
	     <?php $all_tasks = $fpm->getAllCompletedTasks(); ?>
	      <div class="table-responsive">
			<table class="table">
              <thead>
                <tr>
                  <th>Project</th>
                  <th>Task</th>
                  <th>Assignee</th>
                  <th>Completion Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach($all_tasks as $task) { ?>
                  <tr>
                   <td><em><a href="view-tasks.php?project=<?php print $task['project']; ?>"><?php print $task['pname']; ?></a></em></td>
                   <td><?php print $task['task']; ?></td>
                   <td <?php print ($task['assignee'] == $_SESSION['fpm_username'] ? 'class="text-success"' : ''); ?>><?php print $task['assignee']; ?></td>
                   <td><?php print date('F d, Y', strtotime($task['completeDate'])); ?></td>
                   <td><a href="view-task.php?id=<?php print $task['id']; ?>" class="btn btn-info btn-xs">View Details</a>
                  </tr>
                 <?php } ?>
              </tbody>
            </table>
		 </div>
</div>	    
</div>