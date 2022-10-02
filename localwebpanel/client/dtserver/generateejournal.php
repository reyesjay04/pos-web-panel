<?php session_start();
require('../../resources/functions.php');

$storeid = $_GET['storeid'];
$salestype = $_GET['salestype'];
$transactiontype = $_GET['transactiontype'];
$string = $_GET['daterange'];
$array = explode(' - ', $string);

$Count = 0;
$Date1 = "";
$Date2 = "";

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

$table = 'admin_daily_transaction_details';
$primaryKey = 'details_id';

if ($salestype == "All") { 
    $FinalWhere = '';
    $columns = array(
        array('db' => 'product_name', 'dt' => 0 ),
        array('db' => 'transaction_number', 'dt' => 1 ),
        array('db' => 'quantity', 'dt' => 2 ),
        array('db' => 'price', 'dt' => 3 ),
        array('db' => 'total', 'dt' => 4 ),
        array('db' => 'created_at', 'dt' => 5 ),
        array('db' => 'product_sku', 'dt' => 6 ),
    );

    if ($transactiontype == "All(Cash)") {
        $FinalWhere = "date(created_at) >= '" .$Date1. "' AND date(created_at) <= '" .$Date1. "' AND active = 1 AND transaction_type IN('Walk-In','Registered')";
    } elseif ($transactiontype == "All(Others)") {
        $FinalWhere = "date(created_at) >= '" .$Date1. "' AND date(created_at) <= '" .$Date1. "' AND active = 1 AND transaction_type NOT IN('Walk-In','Registered')";
    } else {
        $FinalWhere = "date(created_at) >= '" .$Date1. "' AND date(created_at) <= '" .$Date1. "' AND active = 1 AND transaction_type = '" .$transactiontype. "'";
    }

    require('../../resources/ssp.class.php');
    echo json_encode(
        SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=''.$FinalWhere.'')
    );

} elseif ($salestype == "VAT") {
    $extraWhere = '';
    $joinQuery = "FROM `admin_daily_transaction_details` AS `LDT` JOIN `admin_daily_transaction` AS `LD` ON (`LDT`.`transaction_number` = `LD`.`transaction_number`)";
    $columns = array(
        array( 'db' => '`LDT`.`product_name`', 'dt' => 0 ,  'field' => 'product_name'),
        array( 'db' => '`LDT`.`transaction_number`',  'dt' => 1, 'field' => 'transaction_number' ),
        array( 'db' => '`LDT`.`quantity`',   'dt' => 2 , 'field' => 'quantity'),
        array( 'db' => '`LDT`.`price`',     'dt' => 3, 'field' => 'price'),
        array( 'db' => '`LDT`.`total`',     'dt' => 4, 'field' => 'total' ),
        array( 'db' => '`LDT`.`created_at`',     'dt' => 5, 'field' => 'created_at' ),
        array( 'db' => '`LDT`.`product_sku`',     'dt' => 6, 'field' => 'product_sku')      
    );

    if ($transactiontype == "All(Cash)") {
        $extraWhere = "date(`LD`.`created_at`) >= '".$Date1."' AND date(`LD`.`created_at`) <= '".$Date2."' AND `LD`.`discount_type` = 'N/A' AND `LD`.`zeroratedsales` = 0 AND `LD`.`active` = 1 AND `LD`.`transaction_type` IN('Walk-In','Registered')";
    } elseif($transactiontype == "All(Others)") {
        $extraWhere = "date(`LD`.`created_at`) >= '".$Date1."' AND date(`LD`.`created_at`) <= '".$Date2."' AND `LD`.`discount_type` = 'N/A' AND `LD`.`zeroratedsales` = 0 AND `LD`.`active` = 1 AND `LD`.`transaction_type` NOT IN('Walk-In','Registered')";
    } else {
        $extraWhere = "date(`LD`.`created_at`) >= '".$Date1."' AND date(`LD`.`created_at`) <= '".$Date2."' AND `LD`.`discount_type` = 'N/A' AND `LD`.`zeroratedsales` = 0 AND `LD`.`active` = 1 AND `LD`.`transaction_type` = '" .$transactiontype. "'";
    }

    require('../../resources/ssp.php');
    echo json_encode(
        SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $joinQuery, $extraWhere)
    );

} elseif($salestype == "NONVAT") {
    $extraWhere = '';
    $joinQuery = "FROM `admin_daily_transaction_details` AS `LDT` JOIN `admin_daily_transaction` AS `LD` ON (`LDT`.`transaction_number` = `LD`.`transaction_number`)";
    $columns = array(

        array( 'db' => '`LDT`.`product_name`', 'dt' => 0 ,  'field' => 'product_name'),
        array( 'db' => '`LDT`.`transaction_number`',  'dt' => 1, 'field' => 'transaction_number' ),
        array( 'db' => '`LDT`.`quantity`',   'dt' => 2 , 'field' => 'quantity'),
        array( 'db' => '`LDT`.`price`',     'dt' => 3, 'field' => 'price'),
        array( 'db' => '`LDT`.`total`',     'dt' => 4, 'field' => 'total' ),
        array( 'db' => '`LDT`.`created_at`',     'dt' => 5, 'field' => 'created_at' ),
        array( 'db' => '`LDT`.`product_sku`',     'dt' => 6, 'field' => 'product_sku')
        
    );

    if ($transactiontype == "All(Cash)") {
        $extraWhere = "date(`LD`.`created_at`) >= '".$Date1."' AND date(`LD`.`created_at`) <= '".$Date2."' AND `LD`.`discount_type` = 'Percentage(w/o vat)' AND `LD`.`zeroratedsales` = 0 AND `LD`.`active` = 1 AND `LD`.`transaction_type` IN('Walk-In','Registered')";
    } elseif($transactiontype == "All(Others)") {
        $extraWhere = "date(`LD`.`created_at`) >= '".$Date1."' AND date(`LD`.`created_at`) <= '".$Date2."' AND `LD`.`discount_type` = 'Percentage(w/o vat)' AND `LD`.`zeroratedsales` = 0 AND `LD`.`active` = 1 AND `LD`.`transaction_type` NOT IN('Walk-In','Registered')";
    } else {
        $extraWhere = "date(`LD`.`created_at`) >= '".$Date1."' AND date(`LD`.`created_at`) <= '".$Date2."' AND `LD`.`discount_type` = 'Percentage(w/o vat)' AND `LD`.`zeroratedsales` = 0 AND `LD`.`active` = 1 AND `LD`.`transaction_type` = '" .$transactiontype. "'";
    }


    require('../../resources/ssp.php');
    echo json_encode(
        SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $joinQuery, $extraWhere)
    );
} else {

    $extraWhere = '';
    $joinQuery = "FROM `admin_daily_transaction_details` AS `LDT` JOIN `admin_daily_transaction` AS `LD` ON (`LDT`.`transaction_number` = `LD`.`transaction_number`)";
    $columns = array(

        array( 'db' => '`LDT`.`product_name`', 'dt' => 0 ,  'field' => 'product_name'),
        array( 'db' => '`LDT`.`transaction_number`',  'dt' => 1, 'field' => 'transaction_number' ),
        array( 'db' => '`LDT`.`quantity`',   'dt' => 2 , 'field' => 'quantity'),
        array( 'db' => '`LDT`.`price`',     'dt' => 3, 'field' => 'price'),
        array( 'db' => '`LDT`.`total`',     'dt' => 4, 'field' => 'total' ),
        array( 'db' => '`LDT`.`created_at`',     'dt' => 5, 'field' => 'created_at' ),
        array( 'db' => '`LDT`.`product_sku`',     'dt' => 6, 'field' => 'product_sku')
        
    );

    if ($transactiontype == "All(Cash)") {
        $extraWhere = "date(`LD`.`created_at`) >= '".$Date1."' AND date(`LD`.`created_at`) <= '".$Date2."' AND LD.zeroratedsales > 0 AND LD.transaction_type IN('Walk-In','Registered')";
    } elseif($transactiontype == "All(Others)") {
        $extraWhere = "date(`LD`.`created_at`) >= '".$Date1."' AND date(`LD`.`created_at`) <= '".$Date2."' AND LD.zeroratedsales > 0 AND LD.transaction_type NOT IN('Walk-In','Registered')";
    } else {
        $extraWhere = "date(`LD`.`created_at`) >= '".$Date1."' AND date(`LD`.`created_at`) <= '".$Date2."' AND LD.zeroratedsales > 0 AND LD.transaction_type = '".$transactiontype."' ";
    }

    require('../../resources/ssp.php');
    echo json_encode(
        SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $joinQuery, $extraWhere)
    );
}





?>

