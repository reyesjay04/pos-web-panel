<?php
ini_set('precision', '15');
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
$report_arr = array();
$store_id = $_GET['storeid'];
$productid = $_GET['productid'];
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
$filter_product = '';
$filter_transaction_type = '';
$filter_coupon_type = '';
 
// Excel file name for download 
$fileName = "CustomReport.xls";

$header1 = array('Date From - To:', $_GET['dateval'], '', '','','',''); 
$excelData = implode("\t", array_values($header1)) . "\n"; 
$header2 = array('Product Name:', $productid, '', '','','',''); 
$excelData .= implode("\t", array_values($header2)) . "\n";
$header3 = array('Transaction Type:', $transaction_type, '', '','','',''); 
$excelData .= implode("\t", array_values($header3)) . "\n";
$header4 = array('Discount Type:', $coupon_type, '', '','','',''); 
$excelData .= implode("\t", array_values($header4)) . "\n";
 

$header5 = array('', '', '', '','','',''); 
$excelData .= implode("\t", array_values($header5)) . "\n";
// Column names 
$fields = array('Store ID', 'Transaction #', 'Product SKU', 'Quantity','Price','Total','Transaction Type','Discount Type','Transaction Date','Read Date');
 
// Display column names as first row 
$excelData .= implode("\t", array_values($fields)) . "\n"; 
 



if($store_id != 'All'){
    $filter_store = " AND a.store_id = '".$store_id."' ";
}

if($productid != 'All'){
    $filter_product = " AND a.product_name = '".$productid."' ";
}

if($transaction_type != 'All'){
    if($transaction_type == 'All(Cash)'){
        $filter_transaction_type = " AND a.transaction_type = 'Walk-In' ";
    }else if($transaction_type == 'All(Others)'){
        $filter_transaction_type = " AND a.transaction_type != 'Walk-In' ";
    }else{
        $filter_transaction_type = " AND a.transaction_type = '".$transaction_type."' ";
    }
    
}

if($coupon_type != 'All'){
    $filter_coupon_type = " AND c.discount_type = '".$coupon_type."' ";
}

$sql = "SELECT a.*,DATE(a.created_at) t_date,b.store_name,c.discount_type FROM posrev.admin_daily_transaction_details a 
inner join posrev.admin_outlets b on b.store_id = a.store_id  
inner join posrev.admin_daily_transaction c on c.transaction_number = a.transaction_number
WHERE DATE_FORMAT(a.zreading, '%Y-%m-%d') >= '".$Date1."' AND DATE_FORMAT(a.zreading, '%Y-%m-%d') <= '".$Date2."' 
".$filter_store." ".$filter_product." ".$filter_transaction_type." ".$filter_coupon_type." ";

$result = query($sql);
confirm($result);
$total_items = 0;

while($row = mysqli_fetch_array($result)){
    
    $total_items +=  $row['quantity'];

    $report_arr[] = array("id" => $row['details_id'],"store_name" => $row['store_name'], "name" => $row['product_sku'], 
                        "transaction_number" => $row['transaction_number'], 'quantity' => $row['quantity'] 
                        ,'price'=>$row['price'],'total'=>$row['total'],'Transaction_type'=>$row['transaction_type'],
                        'discount_type'=>$row['discount_type'],
                        'Transaction_date'=>$row['t_date'],'Read_Date'=>$row['zreading']);

    
}
// echo json_encode($report_arr);

for($i = 0; $i < count($report_arr); $i++){
   
    $lineData = array('strore'=>$report_arr[$i]['store_name'],'tn'=>$report_arr[$i]['transaction_number'],
    'prod'=>$report_arr[$i]['name'],'qty'=>$report_arr[$i]['quantity'],'price'=>$report_arr[$i]['price'],
    'total'=>$report_arr[$i]['total'],'Transaction_type'=>$report_arr[$i]['Transaction_type'],
    'discount_type'=>$report_arr[$i]['discount_type'],
    'Transaction_date'=>$report_arr[$i]['Transaction_date'],'date'=>$report_arr[$i]['Read_Date']); 
    array_walk($lineData, 'filterData'); 
    $excelData .= implode("\t", array_values($lineData)) . "\n"; 
}

$sql1 = "SELECT c.* FROM posrev.admin_daily_transaction_details a 
inner join posrev.admin_outlets b on b.store_id = a.store_id  
inner join posrev.admin_daily_transaction c on c.transaction_number = a.transaction_number
WHERE DATE_FORMAT(a.zreading, '%Y-%m-%d') >= '".$Date1."' AND DATE_FORMAT(a.zreading, '%Y-%m-%d') <= '".$Date2."' 
".$filter_store." ".$filter_product." ".$filter_transaction_type." ".$filter_coupon_type." group by c.transaction_number";

$result1 = query($sql1);
confirm($result1);

$total_sales = 0;
$vatable_sales = 0;
$lessvatable_sales = 0;
$discount = 0;
while($row1 = mysqli_fetch_array($result1)){
    $total_sales +=  $row1['amountdue'];
    $vatable_sales +=  $row1['vatablesales'];
    $lessvatable_sales +=  $row1['lessvat'];
    $discount +=  $row1['totaldiscount'];
}

$spacer = array('', '', '', '','','',''); 
$excelData .= implode("\t", array_values($spacer)) . "\n";

$footer1 = array('Total Items:', $total_items, '', '','','',''); 
$excelData .= implode("\t", array_values($footer1)) . "\n"; 
$footer2 = array('Net Sales', number_format($total_sales,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer2)) . "\n";
$footer3 = array('Vatable Sales', number_format($vatable_sales,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer3)) . "\n";
$footer4 = array('Less Vat Sales', number_format($lessvatable_sales,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer4)) . "\n";
$footer6 = array('Discounts', number_format($discount,2), '', '','','',''); 
$excelData .= implode("\t", array_values($footer6)) . "\n";
$footer5 = array('Date generated', date('m-d-Y'), '', '','','',''); 
$excelData .= implode("\t", array_values($footer5)) . "\n";

// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;
?>