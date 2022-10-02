<?php
include('../../resources/functions.php');
session_start();
$report_arr = array();
$store_id = $_GET['storeid'];

$Count = 0;
$transaction_type = $_GET['transaction_type'];
$coupon_type = $_GET['coupon_type'];
$array = explode(' - ', $_GET['dateval']);
foreach($array as $value) {

	if($Count == 0 ) {
		$Date1 = $value;
	}elseif ($Count > 0) {
		$Date2 = $value;
	}

$Count += 1;

}

$Date1 = date_create($Date1);
$Date1 = date_format($Date1,"Y-m-d");

$Date2 = date_create($Date2);
$Date2 = date_format($Date2,"Y-m-d");

$filter_store = '';
$filter_transaction_type = '';
$filter_coupon_type = '';

if($store_id != 'All'){
    $filter_store = " AND LD.store_id = '".$store_id."' ";
}else{
    $filter_store = " AND LD.guid = '".$_SESSION['client_user_guid']."' AND LD.active = 1";
}

if($transaction_type != 'All'){
    if($transaction_type == 'All(Cash)'){
        $filter_transaction_type = " AND LD.transaction_type = 'Walk-In' ";
    }else if($transaction_type == 'All(Others)'){
        $filter_transaction_type = " AND LD.transaction_type != 'Walk-In' ";
    }else{
        $filter_transaction_type = " AND LD.transaction_type = '".$transaction_type."' ";
    }
    
}

if($coupon_type != 'All'){
    $filter_coupon_type = " AND LD.discount_type = '".$coupon_type."' ";
}

$sql = "SELECT LD.transaction_number As transaction_number, LD.grosssales as grosssales, LD.vatablesales as vatablesales, 
LD.vatpercentage as vatpercentage, LD.lessvat as lessvat, LD.vatexemptsales as vatexemptsales, IFNULL(SUM(LC.cd_total), 0) as totaldiscount, 
LD.transaction_type as transaction_type, LD.amountdue as amountdue, IFNULL(SUM(LC.cd_gc_val), 0) as gc_value , 
LD.created_at as dateCreated, LD.vatpercentage as AddVat, LD.Active as Status, LD.discount_type FROM admin_daily_transaction as LD 
LEFT JOIN admin_coupon_data LC ON LD.transaction_number = LC.cd_trxno 
WHERE DATE(LD.zreading) BETWEEN '".$Date1."' AND '".$Date2."' 
".$filter_store." ".$filter_transaction_type." ".$filter_coupon_type." 
GROUP BY LD.transaction_number ORDER BY LD.created_at ASC";


$result = query($sql);
confirm($result);
while($row = mysqli_fetch_array($result)){
    
    
    $report_arr[] = array(
        "trxNo" => $row['transaction_number'],
        "gross" => $row['grosssales'], 
        "vatable" => $row['vatablesales'], 
        'vatpercent' => $row['vatpercentage'] ,
        "lessvat" => $row['lessvat'], 
        'vatexemptsales'=>$row['vatexemptsales'],
        'totaldiscount'=>$row['totaldiscount'],
        'transaction_type'=>$row['transaction_type'],
        'gc_value'=>$row['gc_value'],
        'dateCreated'=>$row['dateCreated'],
        'amountdue'=>$row['amountdue'],
        'discount_type'=>$row['discount_type'],
        'add_vat' => $row['AddVat']);
}
echo json_encode($report_arr);
?>