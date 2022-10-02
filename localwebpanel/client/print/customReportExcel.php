<?php
ini_set('precision', '15');
session_start();

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    // if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';

    // force certain number/date formats to be imported as strings
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }

    // escape fields that include double quotes
    if(strstr($str, "'")) $str = str_replace("'", "", $str);
}

include('../../resources/functions.php');

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
 
// Excel file name for download 
$fileName = "CustomReport.xls";

$header1 = array('Date From - To:', $_GET['dateval'], '', '','','',''); 
$excelData = implode("\t", array_values($header1)) . "\n"; 
$header3 = array('Transaction Type:', $transaction_type, '', '','','',''); 
$excelData .= implode("\t", array_values($header3)) . "\n";
$header4 = array('Discount Type:', $coupon_type, '', '','','',''); 
$excelData .= implode("\t", array_values($header4)) . "\n";
 

$header5 = array('', '', '', '','','',''); 
$excelData .= implode("\t", array_values($header5)) . "\n";
// Column names 
$fields = array('Transaction #', 'Store ID', 'Gross Sales' , 'Vatable Sales', '12% Vat','Less Vat','Vat Exempt Sales', 'Add Vat', 'Discount', 'GC Value', 'Amount Due','Transaction Type','Discount Type','Transaction Date');
 
// Display column names as first row 
$excelData .= implode("\t", array_values($fields)) . "\n"; 
 

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
$total_gross = 0;
$total_sales = 0;
$total_vatable = 0;
$total_less_vat = 0;
$total_disc = 0;
$total_items = 0;
$total_add_vat = 0;
$total_vat_exempt = 0;
$total_refund = 0;

$sql = "SELECT LD.transaction_number As transaction_number, LD.grosssales as grosssales, LD.vatablesales as vatablesales, 
LD.vatpercentage as vatpercentage, LD.lessvat as lessvat, LD.vatexemptsales as vatexemptsales, IFNULL(SUM(LC.cd_total), 0) as totaldiscount, 
LD.transaction_type as transaction_type, LD.amountdue as amountdue, IFNULL(SUM(LC.cd_gc_val), 0) as gc_value , 
LD.created_at as dateCreated, LD.vatpercentage as AddVat, LD.Active as Status, LD.discount_type, LD.store_id FROM admin_daily_transaction as LD 
LEFT JOIN admin_coupon_data LC ON LD.transaction_number = LC.cd_trxno 
WHERE DATE(LD.zreading) BETWEEN '".$Date1."' AND '".$Date2."' 
".$filter_store." ".$filter_transaction_type." ".$filter_coupon_type." 
GROUP BY LD.transaction_number ORDER BY LD.created_at ASC";

$result = query($sql);
confirm($result);

while($row = mysqli_fetch_array($result)){
    
    
    $fields = array('Transaction #', 'Store ID', 'Gross Sales' , 'Vatable Sales', '12% Vat','Less Vat','Vat Exempt Sales', 'Add Vat', 'Discount', 'GC Value', 'Amount Due','Transaction Type','Discount Type','Transaction Date');

    $lineData = array(
        "trxNo" => $row['transaction_number'],
        "storeID" => ($store_id == "All" ? $row['store_id'] : $store_id),
        "gross" => $row['grosssales'], 
        "vatable" => $row['vatablesales'], 
        'vatpercent' => $row['vatpercentage'] ,
        "lessvat" => $row['lessvat'], 
        'vatexemptsales'=>$row['vatexemptsales'],
        'add_vat' => $row['AddVat'],
        'totaldiscount'=>$row['totaldiscount'],
        'gc_value'=>$row['gc_value'],
        'amountdue'=>$row['amountdue'],
        'transaction_type'=>$row['transaction_type'],
        'discount_type'=>$row['discount_type'],
        'dateCreated'=>$row['dateCreated']    
    );

    if($row['Status'] == 2) {
        $total_refund += $row['grosssales'];
    }

    $total_items +=  1;
    $total_gross += $row['grosssales'];
    $total_disc += $row['totaldiscount'];
    $total_sales += $row['amountdue'];
    $total_vatable += $row['vatablesales'];
    $total_less_vat += $row['lessvat'];
    $total_add_vat += $row['AddVat'];
    $total_vat_exempt += $row['vatexemptsales'];
    array_walk($lineData, 'filterData'); 
    $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    
}
// echo json_encode($report_arr);

// for($i = 0; $i < count($report_arr); $i++){
   
//     $lineData = array('strore'=>$report_arr[$i]['store_name'],'tn'=>$report_arr[$i]['transaction_number'],
//     'prod'=>$report_arr[$i]['name'],'qty'=>$report_arr[$i]['quantity'],'price'=>$report_arr[$i]['price'],
//     'total'=>$report_arr[$i]['total'],'Transaction_type'=>$report_arr[$i]['Transaction_type'],
//     'discount_type'=>$report_arr[$i]['discount_type'],
//     'Transaction_date'=>$report_arr[$i]['Transaction_date'],'date'=>$report_arr[$i]['Read_Date']); 
//     array_walk($lineData, 'filterData'); 
//     $excelData .= implode("\t", array_values($lineData)) . "\n"; 
// }




$spacer = array('', '', '', '','','',''); 
$excelData .= implode("\t", array_values($spacer)) . "\n";

$footer1 = array('Total Items:', $total_items, '', '','','',''); 
$excelData .= implode("\t", array_values($footer1)) . "\n"; 

$footer2 = array('Total Gross Sales', number_format($total_gross,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer2)) . "\n";

$footer3 = array('Total Discount', number_format($total_disc,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer3)) . "\n";

$footer4 = array('Net Sales', number_format($total_sales,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer4)) . "\n";

$footer6 = array('Vatable Sales', number_format($total_vatable,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer6)) . "\n";

$footer5 = array('Less Vat', number_format($total_less_vat,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer5)) . "\n";

$footer7 = array('Add Vat', number_format($total_add_vat,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer7)) . "\n";

$footer8 = array('Vat Exempt Sales', number_format($total_vat_exempt,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer8)) . "\n";

$footer9 = array('Refunded/Cancel', number_format($total_refund,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer9)) . "\n";

$footer10 = array('Date Generated', date('m-d-Y H:m:s'), '', '','','',''); 
$excelData .= implode("\t", array_values($footer10)) . "\n";

// $total_refund += $row['grosssales'];


// $total_items +=  1;
// $total_gross += $row['grosssales'];
// $total_disc += $row['totaldiscount'];
// $total_sales += $row['amountdue'];
// $total_vatable += $row['vatablesales'];
// $total_less_vat += $row['lessvat'];
// $total_add_vat += $row['AddVat'];
// $total_vat_exempt += $row['vatexemptsales'];
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;
?>