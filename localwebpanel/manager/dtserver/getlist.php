<?php session_start();

include_once '../../resources/functions.php';
$User_List = array();


$query = query("SELECT * FROM posrev.admin_message WHERE guid IN (".$_SESSION['manager_store_guid'].")  GROUP BY `from` ORDER BY `created_at` desc");

confirm($query);

while ($row = fetch_array($query)) { 

  $From = $row['from'];
  $DateCreated = $row['created_at'];            
  $MsgContent = $row['content']; 
  $EmailAdd = $row['email']; 
  $MessageID = $row['message_id']; 
  $synced = $row['synced'];
  $User_List[] = array("Read" => $synced, "From" => $From, "DateCreated" => $DateCreated, "Content" => $MsgContent);
           
}
echo json_encode($User_List);
?>
  