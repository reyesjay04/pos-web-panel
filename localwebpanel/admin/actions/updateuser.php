<?php

	include '../../resources/functions.php';

    $user_guid            = $_POST['userguid'];
    $user_fname           = $_POST['fname'];
    $user_lname           = $_POST['lname'];
    $user_name            = $_POST['username'];
    $user_email           = $_POST['email'];
    $contact_no           = $_POST['contactno'];
    $user_pass            = $_POST['password'];
    $image_base64         = '';
    
    $datenow = FullDateFormat24HR();

    $password = base64_encode($user_pass);
    $password_crypt = md5($password);
    if($_FILES['image']['size'] == 0 && $_FILES['image']['error'] == 0){
        $FileData = file_get_contents($_FILES["image"]["tmp_name"]);
        $image_base64 .= base64_encode($FileData);
    } else {
        $get_pic = query("SELECT user_profile FROM admin_user WHERE user_guid = '$user_guid' ");
        confirm($get_pic);
        while($pic = fetch_array($get_pic)) {
        $image_base64 = $pic['user_profile'];
        } 
    }
    $query  = "UPDATE admin_user SET ";
    $query .= "user_name         = '{$user_name}'  ,";
    $query .= "user_fname          = '{$user_fname}'   ,";
    $query .= "user_lname        = '{$user_lname}' ,";
    $query .= "user_email         = '{$user_email}'  , ";
    $query .= "contact_no     = '{$contact_no}'  , ";
    $query .= "user_pass      = '{$password_crypt}', ";
    $query .= "user_profile       = '{$image_base64}'      ";
    $query .= "WHERE user_guid = '{$user_guid}' ";

    $send_update_query = query($query);
    confirm($send_update_query);
    echo '<script>';
    echo 'alert("Successfully updated a user!");';
    echo 'self.location = "../?users";';
    echo '</script>';
?>

