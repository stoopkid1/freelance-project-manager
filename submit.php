<?php
include( 'developer/lib/class.db.php' );
include( 'developer/lib/class.fpm.php' );
$fpm = new fpm();
	if( isset( $_POST['form'] ) ) {
		$form 	= $_POST['form'];

		switch( $form ) {
			case 'signup':
				$email 		= $_POST['email'];
				$password 	= $_POST['password'];
				$confirm 	= $_POST['confirm'];

				$fpm->developerRegistration($email, $password, $email);
				break;

			default:
				break;
		}

	} else {
		// no form was submitted
		return;
	}

?>