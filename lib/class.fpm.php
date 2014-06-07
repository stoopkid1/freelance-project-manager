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
		$saltData = $this->fetch("SELECT salt, hash, role, status FROM `" . $this->prefix . "users` WHERE username = '$username'");
		$salt  	  = $saltData['0']['salt'];
		$hash  	  = $saltData['0']['hash'];
		$guild_id = $saltData['0']['guild'];
		$role  	  = $saltData['0']['role'];
		$status   = $saltData['0']['status'];
		$hashCheck = crypt($password, $hash);
		if($hashCheck === $hash) {
			if($status == 1) {
				print "Account suspended. Please contact the Admins";
				exit();
			}
			$_SESSION['fpm_username'] = $username;
			if($role == 'admin') {
				$_SESSION['fpm_admin'] = $username;
			}
		
			print "Logging in...";
		} else {
			print "Incorrect username or password";
		}
	}
	/*
	 * Create User
	* strength - [1-10] strength of the salt
	* salt and hash - each user has a unique salt combined with a hash
	* the password is not stored
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
	
	function getCompanies() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "companies`");
		 return $data;
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
		$data = $this->fetch("SELECT `" . $this->prefix . "projects`.*, `" . $this->prefix . "companies`.id,
									 `" . $this->prefix . "companies`.company
							  FROM `" . $this->prefix . "projects`, `" . $this->prefix . "companies`
							  WHERE `" . $this->prefix . "projects`.status = '1'
							  AND	`" . $this->prefix . "projects`.company = `" . $this->prefix . "companies`.id
							  ORDER BY `" . $this->prefix . "projects`.company
							");
		return $data;
	}
	
	function getPastProjects() {
		$data = $this->fetch("SELECT `" . $this->prefix . "projects`.*, `" . $this->prefix . "companies`.id,
									 `" . $this->prefix . "companies`.company
							  FROM `" . $this->prefix . "projects`, `" . $this->prefix . "companies`
							  WHERE `" . $this->prefix . "projects`.status = '0'
							  AND	`" . $this->prefix . "projects`.company = `" . $this->prefix . "companies`.id
							  ORDER BY `" . $this->prefix . "projects`.company
							");
		return $data;
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
							  WHERE `" . $this->prefix . "tasks`.status = '0'
							  AND `" . $this->prefix . "tasks`.project = `" . $this->prefix . "projects`.id
							  ORDER BY company DESC
							");

		 return $data;
	}
	
	function getAllCompletedTasks() {
		$data = $this->fetch("SELECT `" . $this->prefix . "tasks`.*, `" . $this->prefix . "projects`.id AS pid, 
									 `" . $this->prefix . "projects`.project AS pname
							  FROM `" . $this->prefix . "tasks`, `" . $this->prefix . "projects`
							  WHERE `" . $this->prefix . "tasks`.status = '1'
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
							  WHERE `" . $this->prefix . "tasks`.status = '0' 
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
							  WHERE `" . $this->prefix . "tasks`.status = '1' 
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
	
/*
 * END TASKS
 */	
	
/*
 * USERS
 */	
	
	function getFreelancers() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE role = 'admin' OR role = 'freelancer'");
		 return $data;
	}
	
	function getClients() {
		$data = $this->fetch("SELECT * FROM `" . $this->prefix . "users` WHERE role = 'user'");
		 return $data;
	}
	
/*
 * END USERS
 */	
	
} //end class
?>