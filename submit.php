<?php session_start();
include('lib/class.db.php');
include('lib/class.fpm.php');
include('lib/forum.class.php');

$fpm = new fpm();
$fpm_username = $_SESSION['fpm_username'];

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
		 	default:
		 		break;
		 }

	} else {
		print "nothing was submitted";
	}
?>