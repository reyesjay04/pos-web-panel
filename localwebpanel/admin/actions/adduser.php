<?php
include '../../resources/functions.php';

$user_name            = $_POST['username'];
$user_fname           = $_POST['fname'];
$user_lname           = $_POST['lname'];
$user_email           = $_POST['email'];
$user_pass            = $_POST['password'];
$contact_no           = $_POST['contactno'];
$password 			  = base64_encode($user_pass);
$checked			  = $_POST['r1'];
$password_crypt 	  = md5($password);
$role 				  = $_POST['role'];

if (usernameexist($user_name)) {
	echo '<script>
		  	alert("Username already used");
		    window.location = "../?users"; 
		 </script>';
} else {
	if (checkEmail($user_email)) {
			if (contactnumberexist($contact_no)) {
				echo '<script>
		  				alert("Contact number exist");
		    			window.location = "../?users"; 
		 			  </script>';
			} else {
				include '../../avatar.php';
				if ($checked == 'Female') {
					$Profile = ReturnAvatar('Female');
				} elseif ($checked == 'Male') {
					$Profile = ReturnAvatar('Male');
				} else {
					$Profile = ReturnAvatar('N/A');
				}
				$datetoday = FullDateFormat24HR();
				$fields = '`user_name`, `user_profile`, `user_fname`, `user_lname`, `user_email`, `user_pass`, `user_role`, `contact_no`, `gender`, `date_updated`';
				$values = "'$user_name' , '$Profile', '$user_fname', '$user_lname', '$user_email', '$password_crypt', '$role ', '$contact_no', '$checked', '$datetoday'";
				save('admin_user', $fields ,$values);
				echo '<script>
	  					alert("Registered Successfully");
	    				window.location = "../?users"; 
	 			  	  </script>';
			}
		//}
	} else {
		echo '<script>
				alert("Invalid email address");
				window.location = "../?users"; 
	  		  </script>';
	}				
}			

?>
