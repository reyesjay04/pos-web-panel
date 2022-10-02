<?php
// DB table to use
$table = 'admin_pos_inventory_org';
// Table's primary key
$primaryKey = 'server_inventory_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database. 
// The `dt` parameter represents the DataTables column identifier.
// 
$columns = array(
    array( 
            'db' => 'product_ingredients',
            'dt' => 0
        ),
    array( 'db' => 'stock_primary', 'dt' => 1 ),
    array( 'db' => 'sku', 'dt' => 2 ),
    array( 'db' => 'stock_secondary', 'dt' => 3 ),
    array( 'db' => 'critical_limit', 'dt' => 4 ),
    array( 'db' => 'date_modified', 'dt' => 5 ),
    array( 
        'db' => 'stock_status', 
        'dt' => 6,
        'formatter' => function( $d, $row ) { 
            if ($d == '1') {
                return 'Active';
            } else {
                return 'Deactivated';
            }
        }
         ),
    array( 
        'db' => 'server_inventory_id',
        'dt' => 7 , 
        'formatter' => function( $d, $row ) {
        return ('<div class="btn-group"><button type="button" class="btn btn-info bg-gr" id='.$d.' onclick="editinventory(this.id)"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger" id='.$d.' onclick="deleteinventory(this.id)"><i class="fas fa-trash-alt"></i></button></div>');
        })
);
// Include SQL query processing class
require('../../resources/ssp.class.php');
require('../../resources/functions.php');
// Output data as json format
echo json_encode(
    //SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
    SSP::complex ( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $whereResult=null, $whereAll=' stock_status = 1')
);

?>
