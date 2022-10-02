<?php
// Database connection info
// DB table to use
$table = 'admin_price_request';
// Table's primary key
$primaryKey = 'request_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
// 
$columns = array(
    array( 'db' => 'server_product_id', 'dt' => 0 ),
    array( 'db' => 'request_price','dt' => 1),
    array( 'db' => 'store_name', 'dt' => 2 ),
    array( 'db' => 'guid', 'dt' => 3 ),
    array(
    'db'        => 'active',
    'dt'        => 4,
    'formatter' => function( $d, $row ) {
        return ($d == 1)?'<span data-toggle="tooltip" data-original-title="Active"><i class="fas fa-check-circle"></i> </span>':'<span data-toggle="tooltip" data-original-title="Inactive"><i class="fas fa-times-circle"></i></span>';
        }
    ),    
    array( 'db' => 'created_at', 'dt' => 5 )
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
require('../../resources/functions.php');
// Output data as json format
echo json_encode(
    // SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=' active = "2"')
);

?>
