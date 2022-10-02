<?php
include_once '../../resources/functions.php';
$User_List = array();
$query = query("SELECT * FROM posrev.admin_message ORDER BY `created_at` desc");
confirm($query);
while ($row = fetch_array($query)) { 

  $From = $row['from'];
  $DateCreated = $row['created_at'];            
  $MsgContent = $row['content']; 
  $EmailAdd = $row['email']; 
  $MessageID = $row['message_id']; 
  $synced = $row['synced'];

  $To = ucfirst($row['fname']). ' '. ucfirst($row['lname']);
  $User_List[] = array("Read" => $synced, "To" => $To, "DateCreated" => $DateCreated, "Content" => $MsgContent, "EmailAdd" => $EmailAdd);
           
}
echo json_encode($User_List);
?>

  