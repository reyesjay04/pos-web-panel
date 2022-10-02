<?php session_start();
include('../../resources/functions.php');
$store_arr = array();
$query = query("SELECT SUM(ADT.grosssales) as GrossSales, OT.store_name as StoreName, OT.store_id as StoreID FROM posrev.admin_daily_transaction ADT LEFT JOIN posrev.admin_outlets OT ON ADT.store_id = OT.store_id WHERE ADT.guid = '".$_SESSION['client_user_guid']."' group by OT.store_name order by OT.store_id;");
confirm($query);
while ($row = fetch_array($query)) { 
    $GrossSales = $row['GrossSales'];  
    $StoreName = $row['StoreName'];
    $StoreID = $row['StoreID'];
    $store_arr[] = array("Gross" => $GrossSales, "Name" => $StoreName, "ID" => $StoreID);
}
echo json_encode($store_arr);
?>



