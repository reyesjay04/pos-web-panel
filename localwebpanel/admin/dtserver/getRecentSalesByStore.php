<?php
include('../../resources/functions.php');
$store_arr = array();
$store_id = $_GET['storeid'];

if($store_id == 'All'){
    $filter = " ORDER BY ADT.created_at DESC LIMIT 20; ";
}else{
    $filter = " WHERE OT.store_id = '".$store_id."' ORDER BY ADT.created_at DESC LIMIT 20; ";
}


$sql = "SELECT OT.store_name AS StoreName, OT.store_id AS StoreID, OT.address AS Address, OT.Barangay AS Brgy, OT.municipality AS Municipality, 
                    OT.province AS Province, OT.postal_code AS Postal,ADT.transaction_number, ADT.total,ADT.created_at AS DATE
                    FROM posrev.admin_daily_transaction_details ADT 
                    INNER JOIN posrev.admin_outlets OT ON ADT.store_id = OT.store_id
                    ".$filter;

$result = query($sql);
while($row = mysqli_fetch_array($result)){
    
    $store_id = $row['StoreName'];
    $municipality = selectmunicipality($row['Municipality']);
    $province =  selectprovince($row['Province']);
    $storename =  $row['Address']. ", " . $row['Brgy']. ", ". $municipality.", ". $province. " ". $row['Postal'] ;
    $transaction_number = $row['transaction_number'];
    $total = $row['total'];
    $date = $row['DATE'];
    $store_arr[] = array("id" => $store_id, "name" => $storename, "transaction_number" => $transaction_number, 'total' => $total , 'date'=>$date);
}
echo json_encode($store_arr);
?>