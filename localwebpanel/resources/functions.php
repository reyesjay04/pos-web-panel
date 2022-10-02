<?php
    date_default_timezone_set('Asia/Manila');


    include 'config.php';
    if($_POSURI == "/localwebpanel/") {
        include 'conn.php';
    } else {
        include 'conn-server.php';
    }

    function query($sql){   
        global $connection;
        return mysqli_query($connection, $sql);
    }
    function confirm($results){
        global $connection;
        if (!$results) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
    }
    function escape_string($string){
        global $connection;
        return mysqli_real_escape_string($connection, $string);
    }
    function row_count($result) {
        $result = mysqli_num_rows($result);
        return $result;
    }

    function fetch_array($result) {
        global $connection;
        return mysqli_fetch_array($result); 
    }
    function selectmunicipality($municipalityID){
        $query = query("SELECT mn_name FROM admin_municipality WHERE mn_id = $municipalityID");
        confirm($query);
        $row = mysqli_fetch_array($query);
        $municipality = $row['mn_name'];
        return $municipality;
    }
    function selectprovince($provinceID){
        $query = query("SELECT province FROM admin_province WHERE add_id = $provinceID");
        confirm($query);
        $row = mysqli_fetch_array($query);
        $province = $row['province'];
        return $province;
    }
    function outletcheck($outletid){
        $query = query("SELECT active FROM admin_outlets WHERE store_id = $outletid");
        confirm($query);
        $row = mysqli_fetch_array($query);
        $outlet = $row['active'];
        return $outlet;
    }
    function getacronym($Brandname) {
        $query = query("SELECT acronym FROM admin_brand WHERE brand_name = '$Brandname'" );
        confirm($query);
        $row = mysqli_fetch_array($query);
        $acronym = $row['acronym'];  
        return $acronym;
    }
    function last_id() {
        global $connection;
        return mysqli_insert_id($connection);
    }
    function save($table , $fields, $values) {
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        $result = query($sql);
        if($result) {
            return last_id();
        } else {
            return "Error $results -> $sql";
        }
    }
    function edit($table,$fldnval,$id) {
        $sql    = "UPDATE $table SET $fldnval WHERE id = '$id'";
        $result = query($sql);
        if ($result) {
            return "";
        } else {
            return "Error $result";
        }

    }
    function delete($table,$id) {
        $sql    = "DELETE FROM $table WHERE id = '$id'";
        $result = mysqli_query($sql);
        if ($result) {
            return "";
        } else {
            return "Error $result";
        }
    }
    function select_each($table,$where) {
        $sql = "SELECT * FROM $table $where";
        $rs = mysqli_query($sql);
        if ($rs) {
            if (mysqli_num_rows($rs) > 0) {
                return $rs;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtolower(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 8, 4);
            return $uuid;
        }
    }
    function FullDateFormat24HR() {
      return  date("Y-m-d H:i:s");
    }
    function ReturnDateFormat() {
      return  date("Y-m-d");
    }
    function StoreName($id) {
        $query = query("SELECT store_name FROM admin_outlets WHERE store_id = ". $id);
        confirm($query);
        $row = mysqli_fetch_array($query);
        $store_name = $row['store_name'];
        return $store_name;      
    }
    function getstorename($store_id) {
        $query = query("SELECT * FROM admin_outlets WHERE store_id = '$store_id'" );
        confirm($query);
        while ($row = fetch_array($query)) {
            $store_name = $row['store_name'];  
        }
         return $store_name;
    }

    function ReturnTotalSales($store_id) {
        $query = query("SELECT SUM(amountdue) FROM admin_daily_transaction WHERE store_id = '$store_id'" );
        confirm($query);
        $row = fetch_array($query);
        echo $row['SUM(amountdue)'];
    }

    function checkEmail($email) {
       $find1 = strpos($email, '@');
       $find2 = strpos($email, '.');
       return ($find1 !== false && $find2 !== false && $find2 > $find1);
    }

    function emailexist($email) {
        $query = query("SELECT user_email FROM admin_user WHERE user_email = '$email'" );
        confirm($query);
        $row = fetch_array($query);
        $returnthis = strlen(isset($row['user_email']));
        return $returnthis > 0 ? true : false;
    }

    function usernameexist($username) {
        $query = query("SELECT user_name FROM admin_user WHERE user_name = '$username'" );
        confirm($query);
        $row = fetch_array($query);
        $returnthis = strlen(isset($row['user_name']));
        return $returnthis > 0 ? true : false;        
    }

    function contactnumberexist($contact) {
        $query = query("SELECT contact_no FROM admin_user WHERE contact_no = '$contact'" );
        confirm($query);
        $row = fetch_array($query);
        $returnthis = strlen(isset($row['contact_no']));
        return $returnthis > 0 ? true : false;
    }

    function emailexistCREW($email) {
        $query = query("SELECT email FROM loc_users WHERE email = '".$email."'" );
        confirm($query);
        $row = fetch_array($query);
        $useremail = strlen(isset($row['email']));
        return $useremail > 0 ? true : false;
    }

    function usernameexistCREW($username) {
        $query = query("SELECT username FROM loc_users WHERE username = '".$username."'" );
        confirm($query);
        $row = fetch_array($query);
        $user_name = strlen(isset($row['username']));
        return $user_name > 0 ? true : false;        
    }

    function contactnumberexistCREW($contact) {
        $query = query("SELECT contact_number FROM loc_users WHERE contact_number = '".$contact."'" );
        confirm($query);
        $row = fetch_array($query);
        $contact_no = strlen(isset($row['contact_number']));
        return $contact_no > 0 ? true : false;
    }

    function publicip() {
        $externalContent = file_get_contents('http://checkip.dyndns.com/');
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
        $externalIp = $m[1];
        return $externalIp;
    }
    function userlogs($guid,$log_desc) {
        $table = "`admin_user_logs`";
        $public = publicip();   
        $log_date = FullDateFormat24HR();
        $fields = "`ip`,`guid`,`log_desc`,`log_date`";
        $values = " '$public','$guid','$log_desc','$log_date'";
        save($table , $fields, $values);
    }

    function getmanager($guid) {
        $query = query("SELECT user_fname as FirstName, user_lname as LastName FROM admin_user WHERE user_guid = '".trim($guid)."'" );
        confirm($query);
        $row = fetch_array($query);
        $firstname = '';
        $lastname = '';

        if (isset($row['FirstName'])) {
            $firstname = ucfirst($row['FirstName']) . ' ';
        } else {
            $firstname = "N";
        }
        if (isset($row['LastName'])) {
            $lastname = ucfirst($row['LastName']);
        } else {
            $lastname = "/A";
        }

        $fullname = $firstname.$lastname;
        return $fullname;
        
    }

    function array_to_csv_download($array, $filename) {
        // open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://output', 'w');
        // loop over the input array
        foreach ($array as $line) { 
            // generate csv lines from the inner arrays
            fputcsv($f, $line); 
        }
        // reset the file pointer to the start of the file
        fclose($f);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
    }
    function getTotalSales($guid, $storeid) {
        $query = query("SELECT SUM(amountdue) FROM admin_daily_transaction WHERE guid = '".$guid."' and store_id = '".$storeid."'" );
        confirm($query);
        $row = fetch_array($query);
        if ($row['SUM(amountdue)'] <> '') {
           return $row['SUM(amountdue)'];
        } else {
           return 'N/A';
        }
        
    }

    function UpdateLastLogin($user_id) {
        $datenow = FullDateFormat24HR();
        $sql = "UPDATE `admin_user` SET `last_login`= '$datenow' WHERE user_id = $user_id";
        $result = query($sql);
    }


    
?>