<?php session_start();
include('../../resources/functions.php');
// DB table to use
$table = 'admin_pos_inventory';
// Table's primary key
$primaryKey = 'inventory_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
$columns = array(

    array( 'db' => 'product_ingredients',     'dt' => 0 ),
    array( 'db' => 'sku',     'dt' => 1 ),
    array( 'db' => 'stock_primary',     'dt' => 2 ),
    array( 'db' => 'stock_secondary',     'dt' => 3 ),
    array( 'db' => 'stock_no_of_servings',     'dt' => 4 ),
    array( 'db' => 'stock_status',     'dt' => 5 ),
    array( 'db' => 'critical_limit',     'dt' => 6 ),
    array( 'db' => 'date',     'dt' => 7 )      
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
// Output data as json format
echo json_encode(
    // SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll='store_id = "'.$_GET['viewinv'].'"')
);

?>


