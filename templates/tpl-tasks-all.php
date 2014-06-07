<div class="content-box-header">
  <div class="panel-title">All Active Tasks</div>
</div>
	<div class="content-box-large box-with-header">

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