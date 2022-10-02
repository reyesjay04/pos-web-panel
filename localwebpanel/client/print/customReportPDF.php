<?php
require('htmlToPdf.php');
include('../../resources/functions.php');
session_start();
$report_arr = array();
$store_id = $_POST['storeid'];

$Count = 0;
$transaction_type = $_POST['transaction_type'];
$coupon_type = $_POST['coupon_type'];
$array = explode(' - ', $_POST['dateval']);
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
LD.created_at as dateCreated, LD.vatpercentage as AddVat, LD.Active as Status, LD.discount_type, LD.store_id FROM admin_daily_transaction as LD 
LEFT JOIN admin_coupon_data LC ON LD.transaction_number = LC.cd_trxno 
WHERE DATE(LD.zreading) BETWEEN '".$Date1."' AND '".$Date2."' 
".$filter_store." ".$filter_transaction_type." ".$filter_coupon_type." 
GROUP BY LD.transaction_number ORDER BY LD.created_at ASC";

$result = query($sql);
confirm($result);

$total_gross = 0;
$total_sales = 0;
$total_vatable = 0;
$total_less_vat = 0;
$total_disc = 0;
$total_items = 0;
$total_add_vat = 0;
$total_vat_exempt = 0;
$total_refund = 0;

$t_row = array();
while($row = mysqli_fetch_array($result)){
    
    $t_row[] = array(
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

    $total_items +=  1;
    $total_gross += $row['grosssales'];
    $total_disc += $row['totaldiscount'];
    $total_sales += $row['amountdue'];
    $total_vatable += $row['vatablesales'];
    $total_less_vat += $row['lessvat'];
    $total_add_vat += $row['AddVat'];
    $total_vat_exempt += $row['vatexemptsales'];

    
}
// echo json_encode($report_arr);
// $t_row = array();
// for($i = 0; $i < count($report_arr); $i++){
//     $t_row[] = array('strore'=>$report_arr[$i]['store_name'],'tn'=>$report_arr[$i]['transaction_number'],
//                 'prod'=>$report_arr[$i]['name'],'qty'=>$report_arr[$i]['quantity'],'price'=>$report_arr[$i]['price'],
//                 'total'=>$report_arr[$i]['total'],'Transaction_type'=>$report_arr[$i]['Transaction_type'],
//                 'discount_type'=>$report_arr[$i]['discount_type'],
//                 'Transaction_date'=>$report_arr[$i]['Transaction_date'],'date'=>$report_arr[$i]['Read_Date']);
// }


// $sql1 = "SELECT c.* FROM posrev.admin_daily_transaction_details a 
// inner join posrev.admin_outlets b on b.store_id = a.store_id  
// inner join posrev.admin_daily_transaction c on c.transaction_number = a.transaction_number
// WHERE DATE_FORMAT(a.zreading, '%Y-%m-%d') >= '".$Date1."' AND DATE_FORMAT(a.zreading, '%Y-%m-%d') <= '".$Date2."' 
// ".$filter_store." ".$filter_product." ".$filter_transaction_type." ".$filter_coupon_type." group by c.transaction_number";

// $result1 = query($sql1);
// confirm($result1);

// $total_sales = 0;
// $vatable_sales = 0;
// $lessvatable_sales = 0;
// $discount = 0;
// while($row1 = mysqli_fetch_array($result1)){
//     $total_sales +=  $row1['amountdue'];
//     $vatable_sales +=  $row1['vatablesales'];
//     $lessvatable_sales +=  $row1['lessvat'];
//     $discount +=  $row1['totaldiscount'];
// }


if(isset($_SERVER['HTTPS'])){
    $protocols = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
}
else{
    $protocol = 'http';
}
 $protocol .= "://" . $_SERVER['HTTP_HOST'];

$heading='
      <span>Date From - To: '.$_POST['dateval'].'</span><br>
      <span>Transaction Type: '.$transaction_type.'</span><br>
      <span>Discount Type: '.$coupon_type.'</span><br>';
    
    $footer='
    <span>Total Items : '.$total_items.'</span><br>
    <span>Total Gross Sales : '.number_format($total_gross).'</span><br>
    <span>Total Discount : '.number_format($total_disc).'</span><br>
    <span>Net Sales: '.number_format($total_sales,2).'</span><br>
    <span>Vatable Sales: '.number_format($total_vatable,2).'</span><br>
    <span>Less Vat: '.number_format($total_less_vat,2).'</span><br>
    <span>Add Vat: '.number_format($total_add_vat,2).'</span><br>
    <span>Vat Exempt Sales: '.number_format($total_vat_exempt,2).'</span><br>
    <span>Date generated: '.date('m-d-Y').'</span><br><br><br>
    <strong><i>This report is generated by '.$protocol.'</i><strong>';


    
    $header = array('Transaction #', 'Store ID', 'Gross Sales' , 'Vatable Sales', '12% Vat','Less Vat','Vat Exemt', 'Add Vat', 'Discount', 'GC Value', 'Amount Due','Type','Discount Type','Transaction Date');

    $pdf=new PDF_HTML();
    $pdf->SetFont('Arial','',8);

    $pdf->AddPage('L','Legal',0);
    $pdf->WriteHTML($heading);
    $pdf->BasicTable($header,$t_row);
    $pdf->WriteHTML($footer);
    // $pdf->Output();
    // exit;

    $Filename = $pdf->Output('F');;

    echo $Filename;


?>