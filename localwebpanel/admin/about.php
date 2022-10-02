<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Innovention</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- This  -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" > 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include_once('templates/nav.php');?>
<?php include_once('templates/sidenav.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">About Us</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">About Us</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="card-body">
        <div style="margin-top: 100px;" class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <img class="img-fluid" src="../dist/img/posbg.png" alt="Photo"> 
          </div>
          <div class="col-sm-4"></div>
        </div>  
        <div class="row">
          <div class="col-sm-12 text-center">
            <h1 class="m-0 text-dark">Spearhead MBC Trading</h1>
            <h5 class="m-0 text-dark"><?php echo $_SESSION["client_version"];?></h5>
            <h5 class="m-0 text-dark">© 2021 - Spearhead MBC Trading</h5>
            <h5 class="m-0 text-dark">All Rights Reserve</h5>     
          </div>
        </div>  
        <div class="row">
          <div class="col-sm-12 text-center">
            <a class="btn btn-social-icon btn-facebook" href=""><i class="fab fa-facebook-f fa-3x"></i></li></a>
            <a class="btn btn-social-icon btn-instagram" href=""><i class="fab fa-instagram fa-3x"></i></li></a>
            <a class="btn btn-social-icon btn-google" href=""><i class="fab fa-google fa-3x"></i></li></a>
            <a class="btn btn-social-icon btn-twitter" href=""><i class="fab fa-twitter fa-3x"></i></li></a>
          </div>
        </div>         
      </div>
    </section>
  </div>
<?php include_once('templates/webfooter.php');?>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/demo.js"></script>
<script>
$(document).ready(function(){
  $(".sidebar  a").click(function(){
    $('.sidebar a').removeClass('active');
    $(this).addClass('active');
  })
});
</script>
</body>
</html>
    
