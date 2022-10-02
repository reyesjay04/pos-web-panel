<?php
$guid = $_POST['guid']; 
include('../../resources/functions.php');
$store_arr = array();
$query = query("SELECT log_store, loc_systemlog_id, log_type, log_description, log_date_time, zreading FROM posrev.admin_system_logs WHERE guid = '".$guid."' ORDER BY log_date_time DESC LIMIT 20");
confirm($query);

while ($row = fetch_array($query)) { 

    $storename = "FBW-".$row['log_store'];  
    $logid = $row['loc_systemlog_id'];
    $type = $row['log_type'];
    $desc = $row['log_description'];  
    $datetime = $row['log_date_time'];
    $Zreading = $row['zreading'];

    $store_arr[] = array("Store" => $storename, "LogID" => $logid, "Type" => $type, "Desc" => $desc, "DateTime" => $datetime, "Zreading" => $Zreading);
}
echo json_encode($store_arr);
?>

