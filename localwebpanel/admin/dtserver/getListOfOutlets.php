<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'admin_user';

// Table's primary key
$primaryKey = 'user_id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes


$columns = array(
        array( 'db' => '`b`.`store_id`',    'dt' => 0, 'field' => 'store_id' ),
        array( 'db' => '`b`.`store_name`',  'dt' => 1, 'field' => 'store_name' ),
        array( 'db' => '`b`.`address`',     'dt' => 2, 'field' => 'address' ),
        array( 'db' => '`b`.`location_name`',     'dt' => 3,  'field' => 'location_name' ),
        array( 'db' => '`a`.`user_fname`',     'dt' => 4,  'field' => 'user_fname' ),
        array( 'db' => '`a`.`user_lname`',     'dt' => 5,  'field' => 'user_lname' ),
    );

    $joinQuery = "FROM admin_user a INNER JOIN admin_outlets b ON b.user_id = a.user_id";
    $extraWhere = "";
    
    require('../../resources/ssp.customized.class.php' );
    require('../../resources/functions.php');

    $groupBy = "";
    $having = "";

    echo json_encode(
        SSP::simple( $_GET, ConnectionArray(), $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
    );

?>