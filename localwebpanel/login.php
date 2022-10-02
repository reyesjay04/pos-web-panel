<?php
if(isset($_SESSION['webpanel'])) {
    header("Location: admin/");
} elseif (isset($_SESSION['clientpanel'])) {
    header("Location: client/");
} elseif (isset($_SESSION['managerpanel'])) {
    header("Location: manager/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Innovention</title>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="plugins/jquery/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="dist/css/login.css">
</head>
<?php include_once("resources/functions.php")  ?>
<body class="hold-transition register-page" style="background-color: rgb(220, 122, 52);">
  <div class="register-box">
    <div class="card">
      <div class="card-body register-card-body">
        <div class="text-center">
          <div class="form-group">
            <img src="dist/img/fbwlogo.png" class="rounded" style="width: 200px;" alt="logo">
          </div>        
        </div>
        <p class="login-box-msg">Online POS Management System</p>
        <div class="input-group mb-3">
          <input type="text" class="form-control" autocomplete="off" placeholder="Username" id="username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" autocomplete="off" placeholder="Password" id="password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div> 
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Remember me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="btn" name="submit">Sign in</button>
          </div>
        <p>Dont have an account?&nbsp;</p><a href="?reg" class="text-center">Click here!</a>
        </div>
        <div class="text-center">
          <div id="loader" class=""><div></div><div></div><div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
$(document).ready(function(){
  $("#btn").click(function(){
    document.getElementById("loader").classList.add('lds-facebook');
    var username = $("#username").val();
    var password = $("#password").val();
    if (username != '' & password != '') {
        $.ajax({  
            url:"loginfunction.php",  
            method:"post",  
            data:{
                username:username,
                password:password
            },  
            success:function(data){  
                if(data == "admin"){
                    // alert("Successfully login as Admin");      
                    $("#loader").removeClass("lds-facebook");
                    self.location = "admin/";
                } else if (data == "client") {
                    $("#loader").removeClass("lds-facebook");
                    // alert("Successfully login as Client"); 
                    self.location = "client/";  
                } else if (data == "manager") {
                    $("#loader").removeClass("lds-facebook");
                    // alert("Successfully login as Manager");   
                    self.location = "manager/";  
                } else {
                    $("#loader").removeClass("lds-facebook");
                    alert("Wrong Credentials.");            
                }
            }  
           });  
    } else {
        alert("Please fill up all fields");
        $("#loader").removeClass("lds-facebook");
    }
  });
});
</script>
</body>
</html>   
