<?php

// DB table to use
$table = 'admin_products_org';
// Table's primary key
$primaryKey = 'product_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
// 
$columns = array(
    array( 
        'db' => 'product_sku', 'dt' => 0
            // 'db' => 'product_image',
            // 'dt' => 0,
            // 'formatter' => function( $d, $row ) {
            //     return ('<img src="data:image/png;base64,'.$d.'" class="img-size-50 mr-3 img-circle"
            //     style="opacity: .8; height: 40px;">');
            // }
        ),
    array( 'db' => 'product_sku', 'dt' => 1 ),
    array( 'db' => 'product_price', 'dt' => 2 ),
    array( 'db' => 'product_category', 'dt' => 3 ),
    array( 
        'db' => 'product_status', 
        'dt' => 4,
        'formatter' => function( $d, $row ) { 
            if ($d == '1') {
                return 'Active';
            } else {
                return 'Deactivated';
            }
        }
         ),
    array( 'db' => 'date_modified', 'dt' => 5 ),
    array( 
        'db' => 'product_id',
        'dt' => 6 , 
        'formatter' => function( $d, $row ) {
        return ('<div class="btn-group"><button type="button" class="btn btn-info bg-gr" id='.$d.' onclick="editproduct(this.id)"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger" id='.$d.' onclick="deleteproduct(this.id)"><i class="fas fa-trash-alt"></i></button></div>');
        }),
    array( 'db' => 'product_name', 'dt' => 7 )
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
require('../../resources/functions.php');
// Output data as json format
echo json_encode(
    //SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=' product_status = 1')
);

?>
