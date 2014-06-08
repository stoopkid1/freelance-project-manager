<?php session_start();
include('lib/class.db.php');
include('lib/class.fpm.php');

$fpm = new fpm();
$fpm_username = trim($_SESSION['fpm_username']);

	if(isset($_POST['form'])) {
		$form = $_POST['form'];
		 switch($form) {
/*
 * LOGIN, REGISTRATION & INSTALLATION
 */		 
		 	case 'login':
		 		$username = $_POST['username'];
		 		$password = $_POST['password'];
		 		 $fpm->login($username, $password);
		 		break;
		 	case 'register':
		 		$username	= $_POST['username'];
		 		$password	= $_POST['password'];
		 		$confirm	= $_POST['confirm'];
		 		$email		= $_POST['email'];
		 		 $fpm->register($username, $password, $email);
		 		break;
		 	case 'reset_password':
		 		$email 		= $_POST['email'];
		 		 $fpm->resetPassword($email);
		 		break;
		 	case 'new_password':
		 		$id 		= $_POST['user_id'];
		 		$password	= $_POST['password'];
		 		 $fpm->changePassword($id, $password);
		 		break;
/*
 * END LOGIN, REGISTRATION & INSTALLATION
 */		 		
		 		
/*
 * START CREATIONS
 */		 		
		 		
		 	case 'add-client':
		 		$company		= $_POST['company'];
		 		$owner			= $_POST['owner'];
		 		$website		= $_POST['website'];
		 		$email 			= $_POST['email'];
		 		 $fpm->addClient($company, $owner, $website, $email);
		 		break;
		 		
/*
 * END CREATIONS
 */

/*
 * START PROJECTS
 */		 
			
		 	case 'project-update-status':
		 		$project		= $_POST['project'];
		 		$status			= $_POST['status'];	
		 		 $fpm->updateProjectStatus($project, $status);
		 		break;
		 		
		 	case 'project-update-description':
		 		$project		= $_POST['project'];
		 		$description	= $_POST['description'];
		 		 $fpm->updateProjectDescription($project, $description);
		 		break;
		 		
		 	case 'task-create':
		 		$project		= $_POST['project'];
		 		$task			= $_POST['task'];
		 		$description	= $_POST['description'];
		 		$assignee		= $_POST['assignee'];
		 		$priority		= $_POST['priority'];
		 		$due_date		= $_POST['due_date'];
		 		$company		= $_POST['company'];
		 		 $fpm->createTask($project, $task, $description, $priority, $assignee, $due_date, $company);
		 		break;
/*
 * END PROJECTS
 */		

/*
 * START TASKS
 */		 		
		 	
		 	case 'task-update-status':
		 		$task_id		= $_POST['task'];
		 		$status			= $_POST['status'];
		 		 $fpm->updateTaskStatus($task_id, $status);
		 		break;
		 		
		 	case 'task-update-description':
		 		$task_id		= $_POST['task'];
		 		$description 	= $_POST['description'];
		 		 $fpm->updateTaskDescription($task_id, $description);
		 		break;
		 		
		 	case 'task-update-progress':
		 		$task_id		= $_POST['task'];
		 		$progress		= $_POST['progress'];
		 		 $fpm->updateTaskProgress($task_id, $progress);
		 		break;
		 		
		 	case 'task-add-note':
		 		$task_id		= $_POST['task'];
		 		$note			= $_POST['note'];
		 		 $fpm->addTaskNote($task_id, $note, $fpm_username);
		 		break;
		 		
/*
 * END TASKS
 */		 		
		 	default:
		 		break;
		 }

	} else {
		print "nothing was submitted";
	}
?>