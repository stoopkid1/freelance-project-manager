	<div class="content-box-header">
		<div class="panel-title">My Active Tasks</div>
	</div>
	<div class="content-box-large box-with-header">

	     <?php $all_tasks = $fpm->getUserActiveTasks($fpm_username); ?>
	      <div class="table-responsive">
				<table class="table">
              <thead>
                <tr>
                  <th>Project</th>
                  <th>Task</th>
                  <th>Created</th>
                  <th>Completion %</th>
                  <th>Due Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach($all_tasks as $task) { ?>
                  <tr>
                   <td><em><a href="view-tasks.php?project=<?php print $task['project']; ?>"><?php print $task['pname']; ?></a></em></td>
                   <td><?php print $task['task']; ?></td>
                   <td><?php print date('F d, Y', strtotime($task['created'])); ?></td>
                   <td>
                   	<div class="progress">
  					 <div class="progress-bar" role="progressbar" aria-valuenow="<?php print $task['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php print $task['percent']; ?>%;">
    				  <?php print $task['percent']; ?>%
  					 </div>
					</div>
				   </td>
				   <td>
				   	<?php if(strtotime($task['dueDate']) <= strtotime('now')) { ?>
				   		<span class="text-danger"><?php print date('F d, Y', strtotime($task['dueDate'])); ?></span>
				   	<?php } else { ?>
				   		<span class="text-success"><?php print date('F d, Y', strtotime($task['dueDate'])); ?></span>
				   	<?php } ?>
				   </td>
                   <td><a href="view-task.php?id=<?php print $task['id']; ?>" class="btn btn-info btn-xs">View Details</a>
                  </tr>
                 <?php } ?>
              </tbody>
            </table>
		 </div>
	</div>
