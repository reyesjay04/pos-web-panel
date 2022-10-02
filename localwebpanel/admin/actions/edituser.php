<?php
include '../../resources/functions.php';
$user_id =  $_POST['id'];
$sql = "SELECT * FROM admin_user WHERE user_id = '$user_id'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);
$fname = $row['user_fname'];
$lname = $row['user_lname'];
$username = $row['user_name'];
$email = $row['user_email'];
$contactno = $row['contact_no'];
$image = $row['user_profile'];
echo 
'<div class="card-body">
    <input type="hidden" id="guid" name="userguid" value="'.$user_id.'">
    <div class="row">
      <div class="col-md-6">
      <label>First Name</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required value="'.$fname.'"> 
        </div>         
      </div>
      <div class="col-md-6">
        <label>Last Name</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required value="'.$lname.'">
        </div>         
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <label>Username</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required value="'.$username.'">
        </div>         
      </div>
      <div class="col-md-6">
        <label>Contact Number</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact Number" required value="'.$contactno.'">
        </div>         
      </div>
    </div>
    <label>Email</label>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="'.$email.'">
    </div>
</div>';
?>
