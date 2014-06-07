<div class="content-box-header">
  <div class="panel-title">All Completed Tasks</div>
</div>
	<div class="content-box-large box-with-header">

	     <?php $all_tasks = $fpm->getAllCompletedTasks(); ?>
	      <div class="table-responsive">
			<table class="table">
              <thead>
                <tr>
                  <th>Project</th>
                  <th>Assignee</th>
                  <th>Created</th>
                  <th>Completion Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach($all_tasks as $task) { ?>
                  <tr>
                   <td><em><a href="view-tasks.php?project=<?php print $task['project']; ?>"><?php print $task['pname']; ?></a></em></td>
                   <td <?php print ($task['assignee'] == $_SESSION['fpm_user'] ? 'class="text-success"' : ''); ?>><?php print $task['assignee']; ?></td>
                   <td><?php print date('F d, Y', strtotime($task['created'])); ?></td>
                   <td><?php print date('F d, Y', strtotime($task['completeDate'])); ?></td>
                   <td><a href="view-task.php?id=<?php print $task['id']; ?>" class="btn btn-info btn-xs">View Details</a>
                  </tr>
                 <?php } ?>
              </tbody>
            </table>
		 </div>
	    
</div>