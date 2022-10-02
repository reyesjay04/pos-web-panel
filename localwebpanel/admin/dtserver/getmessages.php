<?php

include_once '../../resources/functions.php';
$User_List = array();

$query = query("SELECT * FROM posrev.admin_message WHERE `email` = '".$_POST['id']."' order by message_id desc");
confirm($query);
while ($row = fetch_array($query)) {

	$FullName = ucfirst($row['fname']) . ' ' . ucfirst($row['lname']); 
	$DateCreated = $row['created_at'];
	$MsgContent = $row['content'];
	$User_List[] = array("FullName" => $FullName, "DateCreated" => $DateCreated, "Content" => $MsgContent);

	$query1 = query("UPDATE posrev.admin_message SET synced = 'Synced' WHERE `from` = '".$_POST['id']."'");
	confirm($query1);
}

           
echo json_encode($User_List);
?>
  