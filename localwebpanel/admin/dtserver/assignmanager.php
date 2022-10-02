<?php
Include '../../resources/functions.php';
// DB table to use
$table = 'admin_outlets';
// Table's primary key
$primaryKey = 'store_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
// 
$columns = array(
    array( 'db' => 'brand_name', 'dt' => 0 ),
    array( 'db' => 'store_name', 'dt' => 1 ),
    array( 
        'db' => 'user_guid', 
        'dt' => 2
        , 
        'formatter' => function( $d, $row ) {    
            if (getrows($d) == null) {          
                return 'No Data';
            } else {
                return getrows($d);
            }     
        } 
    )
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
// Output data as json format
echo json_encode(
    SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    //SSP::complex ( $_GET, $dbDetails, $table, $primaryKey, $columns, $whereResult=null, $whereAll='user_guid <> ""')
);

?>
