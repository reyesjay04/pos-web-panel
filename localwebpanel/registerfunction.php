<?php

if ($_POST['id'] == 1) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$contactnumber = $_POST['contactnumber'];
	$password = $_POST['password'];
	$retypepassword = $_POST['retypepassword'];
	$checked = $_POST['checked'];
	$Profile = '';
	$password_b64 = base64_encode($password);
	$password_enc = md5($password_b64);

	if ($firstname == '' || $lastname == ''|| $username == ''|| $email == ''|| $contactnumber == ''|| $password == ''|| $retypepassword == '' ) {
		# code...
		echo "Please fill up all fields";
	} else {
		if ($password == $retypepassword) {
			include 'resources/functions.php';
			if (usernameexist($username)) {
				echo "Username already used";
			} else {
				if (checkEmail($email)) {
					if (emailexist($email)) {
						echo "Email address exist. Please use another email address.";
					} else {
						if (contactnumberexist($contactnumber)) {
							echo "Contact number exist";
						} else {
							include 'avatar.php';
							if ($password == $retypepassword) {
								if ($checked == 'Female') {
									$Profile = ReturnAvatar('Female');
								} elseif ($checked == 'Male') {
									$Profile = ReturnAvatar('Male');
								} else {
									$Profile = ReturnAvatar('N/A');
								}
								$datetoday = FullDateFormat24HR();
								$userguid = getGUID();
								$fields = '`user_name`, `user_profile`, `user_fname`, `user_lname`, `user_email`, `user_pass`, `user_role`, `contact_no`, `user_guid`, `status`, `gender`, `date_updated`';
								$values = "'$username' , '$Profile', '$firstname', '$lastname', '$email', '$password_enc', 'Client', '$contactnumber', '$userguid', 0, '$checked', '$datetoday'";
								save('admin_user', $fields ,$values);
								echo "Registered Successfully";
							# code...
							} else {
								echo 'Password not match';
							}
						}
					}
				} else {
					echo 'Invalid email address';
				}				
			}			
		} else {
			echo "Password did not match";
		}
	}
} else {
	header("Location: /");
}



?>
