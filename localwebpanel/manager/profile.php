<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Innovention</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" > 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include_once('templates/nav.php');?>
<?php include_once('templates/sidenav.php');?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <form action="actions/saveprofile.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-3">
              <div class="card card-warning card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="data:image/png;base64,<?php echo $_SESSION['client_user_profile'];?>" alt="User profile picture">
                  </div>
                  <h3 class="profile-username text-center"><?php echo ucfirst($_SESSION["client_user_fname"]) . ' ' . ucfirst($_SESSION["client_user_lname"]) ;  ?>              
                  </h3>
<!--                   <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="profilepic" class="custom-file-input" id="profilepic" accept="image/x-png,image/gif,image/jpeg">
                      <label class="custom-file-label" for="profilepic">Choose Profile Picture</label>
                    </div>
                  </div> -->
                </div>
              </div>
              <div class="card card-warning" style="height: 500px;">
                <div class="card-header">
                  <h3 class="card-title">Informations</h3>
                </div>
                <div class="card-body">
                  <strong><i class="fas fa-user mr-1"></i> Date Created</strong>
                  <p class="text-muted">
                    <?php echo $_SESSION["client_account_created"];?>
                  </p>
                  <hr>
                  <strong><i class="fas fa-user mr-1"></i> Date Updated</strong>
                  <p class="text-muted">
                    <?php echo $_SESSION["client_account_updated"];?>
                  </p>
                  <hr>
                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Account Status</strong>
                  <p class="text-muted">
                  <?php    
                  $Status = ($_SESSION["client_status"]  == '1') ? '<i class="far fa-check-circle"></i> Activated' : '<i class="far fa-check-times"></i> Not Activated';
                  echo $Status;
                  ?>        
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card" style="height: 697px;">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="settings">
                      <div class="form-horizontal">
                        <div class="form-group row">
                          <label for="Username" class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="Username" placeholder="Username" disabled="" value="<?php echo $_SESSION['client_user_name']; ?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="fname" class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $_SESSION['client_user_fname']; ?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="lname" class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $_SESSION['client_user_lname']; ?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $_SESSION['client_user_email']; ?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="contact" class="col-sm-3 col-form-label">Conntact Number</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" value="<?php echo $_SESSION['client_contact_no']; ?>" required>
                          </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                          <label for="newpass" class="col-sm-3 col-form-label">Change Password(Optional)</label>
                          <div class="col-sm-9">
                            <!-- <input type="password" class="form-control" name="changepass" id="newpass" placeholder="Password"> -->
                            <a class="btn btn-default" data-toggle="modal" data-target="#modal-change-pass">Click Here</a>
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="offset-sm-3 col-sm-9">
                            <button class="btn btn-block btn-warning">Submit</button>
                          </div>     
                        </div>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>
<?php include_once('modals/changepass.php');?>
<?php include_once('templates/webfooter.php');?>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function () {

  var password = document.getElementById("newpass")
    , confirm_password = document.getElementById("conpass");

  function validatePassword(){
    if(password.value != confirm_password.value) {
      confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;


});
function shownewpass() {
  var x = document.getElementById("newpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function showconpass() {
  var y = document.getElementById("conpass");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}
</script>
</body>
</html>
    
