<?php $project_id = $_GET['project']; ?>
 <?php if(is_numeric($project_id)) { ?>
  <?php $project = $fpm->getProject($project_id); ?>
<div class="content-box-header">
	<div class="panel-title"><em><?php print $project['project']; ?></em> Tasks</div>
<div class="panel-options">
	<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-edit"></i></a>
</div>
</div>
<div class="content-box-large box-with-header">
	<?php $all_tasks = $fpm->getProjectTasks($project_id); ?>
	      <div class="table-responsive">
				<table class="table">
              <thead>
                <tr>
                  <th>Task</th>
                  <th>Assignee</th>
                  <th>Due Date</th>
                  <th>Completion %</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach($all_tasks as $task) { ?>
                  <tr>
                   <td><em><?php print $task['task']; ?></em></td>
                   <td <?php print ($task['assignee'] == $_SESSION['fpm_user'] ? 'class="text-success"' : ''); ?>><?php print $task['assignee']; ?></td>
                   <td><?php print date('F d, Y', strtotime($task['dueDate'])); ?></td>
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

<?php } else { ?>
	<h3>Invalid Project ID</h3>
<?php } ?>