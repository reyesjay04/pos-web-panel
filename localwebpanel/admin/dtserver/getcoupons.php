<?php
// DB table to use
$table = 'admin_coupon';
// Table's primary key
$primaryKey = 'ID';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
// 
$columns = array(
    array( 'db' => 'Couponname_','dt' => 0),
    array( 'db' => 'Desc_', 'dt' => 1 ),
    array( 'db' => 'Effectivedate', 'dt' => 2 ),
    array( 'db' => 'Expirydate', 'dt' => 3 ),
    array( 
        'db' => 'ID', 
        'dt' => 4,
        'formatter' => function( $d, $row ) {
        return ('<div class="btn-group"><button type="button" class="btn btn-info bg-gr" id='.$d.' onclick="EditCoupon(this.id)"><i class="fas fa-edit"></i></button></div>');
        }
         )
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
require('../../resources/functions.php');
// Output data as json format
echo json_encode(
    SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns)
    //SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=' status = 1')
);

?>
