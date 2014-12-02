<?php
/************************************************************ 
 * Written By		: Michael Loring						*
 * Started          : June 04, 2014							* 
 * 															*		
 ***********************************************************/

class fpm extends DB_Class {	
	/*
	 * START LOGIN & REGISTER FUNCTIONALITY
	*/
	
	//user login
	function login($username, $password) {
		$saltData = $this->fetch("SELECT salt, hash, role, status, company FROM `" . $this->prefix . "users` WHERE username = '$username'");
		$salt  	  = $saltData['0']['salt'];
		$hash  	  = $saltData['0']['hash'];
		$role  	  = $saltData['0']['role'];
		$status   = $saltData['0']['status'];
		$company  = $saltData['0']['company'];
		$hashCheck = crypt($password, $hash);
		if($hashCheck === $hash) {
			if($status == 1) {
				print "Account suspended. Please contact the Admins";
				exit();
			}
			$_SESSION['fpm_username'] = $username;
			if($role == 'admin') {
				$_SESSION['fpm_admin'] = $username;
				print "Logging into Developer Panel...";
			} elseif($role == 'user') {
				print "Logging into Developer Panel...";
			} else {
				$_SESSION['fpm_company'] = $company;
				print "Logging into Client Panel...";
			}
		
		} else {
			print "Incorrect username or password";
		}
	}
	
	/*
	 * User Registration -- Public Sign-Up
	 */
	function register($username, $password, $email) {
		$strength = '5';
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		//blowfish algorithm
		$salt = sprintf("$2a$%02d$", $strength) . $salt;
		$hash = crypt($password, $salt);
		//check to make sure this username or email does not already exist
		$result = $this->link->query("SELECT * FROM `" . $this->prefix . "users` WHERE (username = '$username') OR (email = '$email')");
		$count = $this->numRows($result);
		if($count > 0) {
			print "<strong>Error</strong> Username or E-Mail already exists";
		} else {
			$this->link->query("INSERT INTO `" . $this->prefix . "users` SET username = '$username', email = '$email', salt = '$salt',
					hash = '$hash', role = 'user'
					");
			print "<strong>Success!</strong> Account has been created. You may now login.";
		}
	}
	
	/*
	 * Create Account -- User Management page
	 */
	function createAccount($email, $first_name, $last_name, $phone, $role, $company, $password) {
		$strength = '5';

		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

		//blowfish algorithm

		$salt = sprintf("$2a$%02d$", $strength) . $salt;

		$hash = crypt($password, $salt);

		//check to make sure this username or email does not already exist

		$result = $this->link->query("SELECT * FROM `" . $this->prefix . "users` WHERE email = '$email'");

		$count = $this->numRows($result);

		if($count > 0) {

			print "<strong>Error</strong> E-Mail already exists";

		} else {

			$this->link->query("INSERT INTO `" . $this->prefix . "users` 
								SET username = '$email', email = '$email', phone = '$phone', first_name = '$first_name',
									last_name = '$last_name', role = '$role', company = '$company', 
									salt = '$salt', hash = '$hash'

							   ");

			print "<strong>Success!</strong> Account has been created. User may now login.";

		}
	}
	
	function resetPassword($email) {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE email = '$email'");
		if(!empty($data)) {
			$password_string = md5(mt_rand());
			$this->link->query("UPDATE `" . $this->prefix . "users` SET forget = '$password_string' WHERE (email = '$email') AND (role = 'admin')");
			$to = $email;
			$subject = 'ezLeague - Password Reset';
			$headers = "From: " . $email . "\r\n";
			$headers .= "Reply-To: ". $email . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = '<html><body>';
			$message .= '<h1>ezLeague Password Reset</h1>';
			$message .= '<p>Click the link below (or paste it in your browser) to complete resetting your password.<br>';
			$message .= '<a href=\'' . $this->site_url . '/reset.php?f=' . $password_string . '\'>' . $this->site_url . '/reset.php?f=' . $password_string . '</a></p>';
			$message .= '<p>If you did not request this password reset, please disregard this email.</p>';
			$message .= '</body></html>';
			mail($to, $subject, $message, $headers);
			print "<strong>Success</strong> Password Reset instructions have been sent.";
		} else {
			print "<strong>Error</strong> $email does not match any account";
		}
	}
	
	function getUsers() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users`");
		 return $data;
	}
	
	function getUser($username) {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE username = '$username'");
		 $user = array(
		 				'id'		=> $data['0']['id'],
		 				'username'  => $data['0']['username'],
		 				'email'		=> $data['0']['email'],
		 				'first_name'=> $data['0']['first_name'],
		 				'last_name' => $data['0']['last_name'],
		 				'phone'		=> $data['0']['phone'],
		 				'company'	=> $data['0']['company'],
		 				'role'		=> $data['0']['role'],
		 				'created'	=> $data['0']['created'],
		 			  );
		  return $user; 
	}
	
	function getUserById($user_id) {

		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE id = '$user_id'");

		 $user = array(

						'id'		=> $data['0']['id'],

						'username'  => $data['0']['username'],

						'email'		=> $data['0']['email'],

						'first_name'=> $data['0']['first_name'],

						'last_name' => $data['0']['last_name'],

						'phone'		=> $data['0']['phone'],

						'company'	=> $data['0']['company'],

						'role'		=> $data['0']['role'],

						'created'	=> $data['0']['created'],

					 );

		  return $user;

	}
	
	function deleteUser($user_id) {
		$user_data = fpm::getUserById($user_id);
		 $username = $user_data['username'];
		  //reset all tasks where the assignee is the user being deleted
		  $this->link->query("UPDATE `" . $this->prefix . "tasks` SET assignee = '' WHERE assignee = '$username'");
		  
		 $this->link->query("DELETE FROM `" . $this->prefix . "users` WHERE id = '$user_id'");
		 print "<strong>Success!</strong> User has been deleted, and all assigned tasks released";
	}
	
/*
 * END USERS
 */	
	
	
/*
 * CLIENTS / COMPANIES
 */	
	
	function getCurrentClients() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "companies` WHERE status = '1'");
		 return $data;
	}
	
	function getPastClients() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "companies` WHERE status = '0'");
		 return $data;
	}
	
	function getClient($id) {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "companies` WHERE id = '$id'");
		 $client = array(
		 					'id'	=> $data['0']['id'],
		 					'company' => $data['0']['company'],
		 					'owner'	  => $data['0']['owner'],
		 					'website' => $data['0']['website'],
		 					'admin'	  => $data['0']['admin'],
		 					'created' => date('F d, Y h:ia', strtotime($data['0']['created'])),
		 					'status'  => $data['0']['status']
		 				);
		 	return $client;
	}
	
	function getClientProjects($client) {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "projects` WHERE company = '$client'");
		 return $data;
	}
	
	function getTotalClients() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "companies`");
		 $total = count($data);
		  return $total;
	}
	
	function getClientID($client) {
		$data = $this->fetch("SELECT id FROM `" . $this->prefix . "companies` WHERE company = '$client'");
		 $id = $data['0']['id'];
		  return $id;
	}
	
	function getCompanyName($company_id) {
		$data = $this->fetch("SELECT company FROM `" . $this->prefix . "companies` WHERE id = '$company_id'");
		 $company = $data['0']['company'];
		  return $company;
	}
	
	
/*
 * END CLIENTS / COMPANIES
 */	
	
	
/*
 * PROJECTS
 */	
	
	function getProjects() {
		$data = $this->fetch("SELECT `" . $this->prefix . "projects`.*, `" . $this->prefix . "companies`.id,
									 `" . $this->prefix . "companies`.company
							  FROM `" . $this->prefix . "projects`, `" . $this->prefix . "companies` 
							  WHERE	`" . $this->prefix . "projects`.company = `" . $this->prefix . "companies`.id
							  ORDER BY `" . $this->prefix . "projects`.company
							");
		 return $data;
	}
	
	function getProject($id) {

		$data = $this->fetch("SELECT `" . $this->prefix . "projects`.*, `" . $this->prefix . "companies`.id,

									`" . $this->prefix . "companies`.company AS ccompany

							  FROM `" . $this->prefix . "projects`, `" . $this->prefix . "companies`

							  WHERE	`" . $this->prefix . "projects`.id = '$id'
							  AND `" . $this->prefix . "projects`.company = `" . $this->prefix . "companies`.id

							");

			$project = array(
								'id'		  => $data['0']['id'],
								'project'	  => $data['0']['project'],
								'type'		  => $data['0']['type'],
								'created'	  => date('F d, Y', strtotime($data['0']['created'])),
								'description' => $data['0']['description'],
								'cid'		  => $data['0']['company'],
								'company'	  => $data['0']['ccompany'],
								'status'	  => $data['0']['status']
							);

		return $project;

	}
	
	function getActiveProjects() {

		$data = $this->fetch("SELECT `" . $this->prefix . "projects`.*, `" . $this->prefix . "companies`.id AS cid,

									 `" . $this->prefix . "companies`.company AS ccompany

							  FROM `" . $this->prefix . "projects`, `" . $this->prefix . "companies`

							  WHERE `" . $this->prefix . "projects`.status = '1'

							  AND	`" . $this->prefix . "projects`.company = `" . $this->prefix . "companies`.id

							  ORDER BY `" . $this->prefix . "projects`.company

							");

		return $data;

	}
	
	function getPastProjects() {

		$data = $this->fetch("SELECT `" . $this->prefix . "projects`.*, `" . $this->prefix . "companies`.id AS cid,

									 `" . $this->prefix . "companies`.company AS ccompany

							  FROM `" . $this->prefix . "projects`, `" . $this->prefix . "companies`

							  WHERE `" . $this->prefix . "projects`.status = '0'

							  AND	`" . $this->prefix . "projects`.company = `" . $this->prefix . "companies`.id

							  ORDER BY `" . $this->prefix . "projects`.company

							");

		return $data;

	}
	
	function updateProjectStatus($project, $status) {
		$this->link->query("UPDATE `" . $this->prefix . "projects` SET status = '$status' WHERE id = '$project'");
		 print "<strong>Success!</strong> Project status updated";
	}
	
	function updateProjectDescription($project, $description) {
		$description = $this->link->real_escape_string($description);
		 $this->link->query("UPDATE `" . $this->prefix . "projects` SET description = '$description' WHERE id = '$project'");
		  print "<strong>Success!</strong> Project description updated";
	}
	
	function getProjectName($project_id) {
		$data = $this->fetch("SELECT project FROM `" . $this->prefix . "projects` WHERE id = '$project_id'");
		 $project = $data['0']['project'];
		  return $project;
	}
	
	function addProject($project, $description, $type, $company) {
		$description = $this->link->real_escape_string($description);
		 $this->link->query("INSERT INTO `" . $this->prefix . "projects` 
		 					 SET project = '$project', description = '$description', type = '$type', company = '$company'
		 					");
		 	print "<strong>Success!</strong> Project has been created";
	}
	
/*
 * END PROJECTS
 */	
	
/*
 * TASKS
 */	
		
	function getAllActiveTasks() {
		$data = $this->fetch("SELECT `" . $this->prefix . "tasks`.*, `" . $this->prefix . "projects`.id AS pid, 
									 `" . $this->prefix . "projects`.project AS pname
							  FROM `" . $this->prefix . "tasks`, `" . $this->prefix . "projects`
							  WHERE `" . $this->prefix . "tasks`.status = '1'
							  AND `" . $this->prefix . "tasks`.project = `" . $this->prefix . "projects`.id
							  ORDER BY company DESC
							");

		 return $data;
	}
	
	function getAllCompletedTasks() {

		$data = $this->fetch("SELECT `" . $this->prefix . "tasks`.*, `" . $this->prefix . "projects`.id AS pid, 
									 `" . $this->prefix . "projects`.project AS pname
							  FROM `" . $this->prefix . "tasks`, `" . $this->prefix . "projects`
							  WHERE `" . $this->prefix . "tasks`.status = '0'
							  AND `" . $this->prefix . "tasks`.project = `" . $this->prefix . "projects`.id
							  ORDER BY company DESC

							");

		return $data;

	}
	
	function getAllTasks() {

		$data = $this->fetch("SELECT `" . $this->prefix . "tasks`.*, `" . $this->prefix . "projects`.id AS pid, 
									 `" . $this->prefix . "projects`.project AS pname
							  FROM `" . $this->prefix . "tasks`, `" . $this->prefix . "projects`
							  WHERE `" . $this->prefix . "tasks`.project = `" . $this->prefix . "projects`.id
							  ORDER BY company DESC

							");

		return $data;

	}
	
	function getUserActiveTasks($username) {
		$data = $this->fetch("SELECT `" . $this->prefix . "tasks`.*, `" . $this->prefix . "projects`.id AS pid, 
									 `" . $this->prefix . "projects`.project AS pname
							  FROM `" . $this->prefix . "tasks`, `" . $this->prefix . "projects`
							  WHERE `" . $this->prefix . "tasks`.status = '1' 
							  AND assignee = '$username'
							  AND `" . $this->prefix . "tasks`.project = `" . $this->prefix . "projects`.id
							  ORDER BY company DESC
							");

		 return $data;
	}
	
	function getUserCompletedTasks($username) {

		$data = $this->fetch("SELECT `" . $this->prefix . "tasks`.*, `" . $this->prefix . "projects`.id AS pid, 
									 `" . $this->prefix . "projects`.project AS pname
							  FROM `" . $this->prefix . "tasks`, `" . $this->prefix . "projects`
							  WHERE `" . $this->prefix . "tasks`.status = '0' 
							  AND assignee = '$username'
							  AND `" . $this->prefix . "tasks`.project = `" . $this->prefix . "projects`.id
							  ORDER BY company DESC

							");

			 return $data;

	}
	
	function getUserTasks($username) {

		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tasks`

							  WHERE assigned = '$username'

							  ORDER BY company DESC

							");

			 return $data;

	}
	
	function getProjectTasks($project_id) {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tasks`

							  WHERE project = '$project_id'

							  ORDER BY created DESC

							");
		 return $data;
	}
	
	function getProjectActiveTasks($project_id) {

		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tasks`

							  WHERE status = '0'

							  AND project = '$project_id'

							  ORDER BY created DESC

							");
		 return $data;

	}
	
	function getTodaysTasks() {
		$data = $this->fetch("SELECT `" . $this->prefix . "tasks`.*, `" . $this->prefix . "projects`.id AS pid, 
									 `" . $this->prefix . "projects`.project AS pname
							  FROM `" . $this->prefix . "tasks`, `" . $this->prefix . "projects`
							  WHERE `" . $this->prefix . "tasks`.project = `" . $this->prefix . "projects`.id
							  AND `" . $this->prefix . "tasks`.dueDate = CURDATE()
							  ORDER BY company DESC
							");
		 return $data;
	}
	
	function createTask($project, $task, $description, $priority, $assignee, $due_date, $company) {
		$description = $this->link->real_escape_string($description);
		$task		 = $this->link->real_escape_string($task);
		 $this->link->query("INSERT INTO `" . $this->prefix . "tasks` 
		 					 SET project = '$project', task = '$task', description = '$description', priority = '$priority',
		 					 assignee = '$assignee', dueDate = '$due_date', company = '$company'
		 					");
		 	print "<strong>Success!</strong> Task has been created";
	}
	
	function getTask($task_id) {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tasks` WHERE id = '$task_id'");
		 $task = array(
		 				'id'		  => $data['0']['id'],
		 				'task'		  => $data['0']['task'],
		 				'description' => $data['0']['description'],
		 				'status'	  => $data['0']['status'],
		 				'project'	  => $data['0']['project'],
		 				'priority'	  => $data['0']['priority'],
		 				'assignee'	  => $data['0']['assignee'],
		 				'dueDate'	  => $data['0']['dueDate'],
		 				'company'	  => $data['0']['company'],
		 				'created'	  => date('F d, Y h:ia', strtotime($data['0']['created'])),
		 				'notes'		  => $data['0']['notes'],
		 				'percent'	  => $data['0']['percent'],
		 				'lastUpdate'  => $data['0']['lastUpdated'],
		 				'completed'   => $data['0']['completeDate']
		 			  );
		 	return $task;
	}
	
	function updateTaskStatus($task_id, $status) {
		//if the task is being marked as completed, set the completion date, percent to 100 and close the task
		if($status == 0) {
			$this->link->query("UPDATE `" . $this->prefix . "tasks` 
								SET status = '$status', lastUpdate = NOW(), completeDate = NOW(), percent = '100'
								WHERE id = '$task_id'
							   ");

			 print "<strong>Success!</strong> Task has been marked as completed and closed";
		} else {
			$this->link->query("UPDATE `" . $this->prefix . "tasks` 
								SET status = '$status', lastUpdate = NOW()
								WHERE id = '$task_id'
							   ");
		 	 print "<strong>Success!</strong> Task has been re-opened";
		}
	}
	
	function updateTaskDescription($task_id, $description) {
		$this->link->query("UPDATE `" . $this->prefix . "tasks` 
							SET description = '$description', lastUpdate = NOW()
							WHERE id = '$task_id'
						   ");
		 print "<strong>Success!</strong> Task description updated";
	}
	
	function updateTaskProgress($task_id, $progress) {
		if($progress < 0) {
		 print "<strong>Error</strong> Progress cannot be negative";	
		} else {
		$this->link->query("UPDATE `" . $this->prefix . "tasks` 
							SET percent = '$progress', lastUpdate = NOW()
							WHERE id = '$task_id'
						   ");
		 print "<strong>Success!</strong> Task progress updated";
		}
	}
	
	function getTaskNotes($task_id) {
		$data = $this->fetch("SELECT notes FROM `" . $this->prefix . "tasks` WHERE id = '$task_id'");
		 $notes = $data['0']['notes'];
		  return $notes;
	}
	
	function addTaskNote($task_id, $note, $fpm_username) {
		$today = date('F d, Y h:ia', strtotime('now'));
		//add the username and date to the note
		$note = "<strong>" . $fpm_username . "</strong> <em>" . $today . "</em> " . $note;
		//sanitize the note string before the query
		$note = $this->link->real_escape_string($note);
		//grab the old notes
		 $old_notes = fpm::getTaskNotes($task_id);
		 //sanitize the old notes
		 $old_notes = $this->link->real_escape_string($old_notes);
		  //combine the 2 note strings
		  $new_notes = $note . "" . $old_notes;
		   //run the query
		   $this->link->query("UPDATE `" . $this->prefix . "tasks` 
		   					   SET notes = '$new_notes', lastUpdate = NOW()
		   					   WHERE id = '$task_id'");
		    print "<strong>Success!</strong> Task notes have been updated";
	}
	
	function getRecentActivity() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "tasks` ORDER BY lastUpdate DESC LIMIT 5");
		 return $data;
	}
	
/*
 * END TASKS
 */	
	
/*
 * USERS
 */	
	
	function getFreelancers() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE role = 'admin' OR role = 'user'");
		 return $data;
	}
	
	function getClients() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE role = 'client'");
		 return $data;
	}
	
	function getCompanies() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "companies`");
		 return $data;
	}
	
	function addClient($company, $owner, $website, $email) {
		$company = $this->link->real_escape_string($company);
		$website = $this->link->real_escape_string($website);
		
		 $this->link->query("INSERT INTO `" . $this->prefix . "companies`
		 					 SET company = '$company', owner = '$owner', website = '$website', email = '$email'
		 					");
		 	print "<strong>Success!</strong> Client has been added";
	}
	
/*
 * END USERS
 */	
	
} //end class
?>