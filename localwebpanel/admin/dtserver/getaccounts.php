<?php 
include_once '../../resources/functions.php';
$get_users = array();
$query = query("SELECT user_id, user_fname, user_lname FROM posrev.admin_user WHERE user_role = 'Client' ");

confirm($query);

while($row = mysqli_fetch_array($query)) {

		$user_id = $row['user_id'];
		$Name = ucfirst($row['user_fname']). ' '. ucfirst($row['user_lname']);
        $get_users[] = array("Name" => $Name, "Value" => $user_id);
           
}
echo json_encode($get_users);
?>
   