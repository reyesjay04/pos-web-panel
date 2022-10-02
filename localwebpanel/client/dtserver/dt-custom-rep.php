<?php session_start();

require('../../resources/functions.php');

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

if($store_id != 'All'){
    $filter_store = " AND a.store_id = '".$store_id."' ";
}else{
    $filter_store = " AND b.user_guid = '".$_SESSION['client_user_guid']."' AND b.active = 2 ";
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




// DB table to use
$table = 'admin_daily_transaction_details';
// Table's primary key
$primaryKey = 'details_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$joinQuery = "FROM `admin_daily_transaction_details` AS `a`
INNER JOIN `admin_outlets` AS `b` on `b`.`store_id` = `a`.`store_id` 
INNER JOIN `admin_daily_transaction` `c` on `c`.`transaction_number` = `a`.`transaction_number`
INNER JOIN `admin_coupon_data` `d` on d.cs_store_id = a.store_id ";

$columns = array(
    array('db' => '`store_name`', 'dt' => 0, ),
    // array('db' => '`transaction_number`', 'dt' => 1 ),
    array('db' => '`grosssales`', 'dt' => 2 ),
    array('db' => '`vatablesales`', 'dt' => 3 ),
    array('db' => '`vatpercentage`', 'dt' => 4 ),
    array('db' => '`lessvat`', 'dt' => 5 ),

    array('db' => '`vatexemptsales`', 'dt' => 5 ),
    array('db' => '`totaldiscount`', 'dt' => 6),
    array('db' => '`product_name`', 'dt' => 7),

    array('db' => '`quantity`', 'dt' => 8 ),
    array('db' => '`price`', 'dt' => 9 ),
    array('db' => '`total`', 'dt' => 5 ),

    // array('db' => '`transaction_type`', 'dt' => 10 ),
    array('db' => '`discount_type`', 'dt' => 11 ),
    // array('db' => '`t_date`', 'dt' => 12 ),
    // array('db' => '`zreading`', 'dt' => 13 ),

);
$extraWhere = "DATE_FORMAT(a.zreading, '%Y-%m-%d') >= '".$Date1."' AND DATE_FORMAT(a.zreading, '%Y-%m-%d') <= '".$Date2."' 
".$filter_store." ".$filter_product." ".$filter_transaction_type." ".$filter_coupon_type." ";
// Include SQL query processing class
 require('../../resources/ssp.php');
// Output data as json format
echo json_encode(   
    //if($role == "All") {
        SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $joinQuery, $extraWhere)
    //} else {
        //SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=''.$FinalRole.'')
    //}
    # code...    
);

?>

