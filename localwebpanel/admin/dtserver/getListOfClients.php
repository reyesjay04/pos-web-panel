<?php
include_once '../../resources/functions.php';
$User_List = array();
$query = query("SELECT * FROM posrev.admin_user where user_role = 'Client' ");
confirm($query);
while ($row = fetch_array($query)) { 

  $guid = $row['user_guid'];
  $fullname = $row['user_fname'].' '.$row['user_lname'];            
  

  $User_List[] = array("id" => $guid, "fullname" => $fullname);
           
}
echo json_encode($User_List);
?>

  