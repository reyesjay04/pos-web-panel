<?php
	include '../../resources/functions.php';
    $brand              = escape_string($_POST['brands']);
    $address            = escape_string($_POST['address']);
    $postal_code        = escape_string($_POST['postalcode']);
    $province           = escape_string($_POST['province']);
    $municipality       = escape_string($_POST['municipality']);
    $tin_no             = escape_string($_POST['tin_no']);
    $tel_no             = escape_string($_POST['tel_no']);
    $barangay           = escape_string($_POST['barangay']);
    $location_name      = escape_string($_POST['location_name']);
    $MIN                = escape_string($_POST['MIN']);
    $MSN                = escape_string($_POST['MSN']);
    $PTUN               = escape_string($_POST['PTUN']);

 	$acronym = getacronym($brand);
    $result = query("SELECT MAX(store_id) AS max_page FROM admin_outlets");
    $row = mysqli_fetch_array($result);
    $storeid =  $row["max_page"] + 1;
    $acro = $acronym.$storeid ;
    $user_id = $_POST["owners"];
    

    $table  = "admin_outlets";
    $fields = "brand_name, store_name, user_id, location_name, address, postal_code, municipality, province, active, tin_no, tel_no, Barangay , MIN, MSN, PTUN, synced, user_guid";
    $values = "'{$brand}','{$acro}','{$user_id}','{$location_name}','{$address}','{$postal_code}','{$municipality}','{$province}','1','{$tin_no}','{$tel_no}','{$barangay}','{$MIN}','{$MSN}','{$PTUN}','Unsynced' ,'{$user_id}' ";
    save($table, $fields, $values);
    echo '<script>';
    echo 'alert("Added Successfully!");';
    echo 'self.location = "../?outlets";';
    echo '</script>';
?>