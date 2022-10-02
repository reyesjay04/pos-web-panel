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
            <h1 class="m-0 text-dark">Price Request Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Price Request Management</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Actions</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <button class="btn btn-sm btn-secondary btn-block mb-3 " data-toggle="modal" data-target="#modal-add-outlet" type="button">Price Change</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Approved</h3>
            </div>
            <div class="card-body">
              <table id="example"class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Server Product ID</th>
                    <th>Request Price</th>
                    <th>Store ID</th>    
                    <th>Guid</th>
                    <th>Status</th>
                    <th>Date Requested</th>                   
                </thead>
                <tfoot>
                  <tr>
                    <th>Server Product ID</th>
                    <th>Request Price</th>
                    <th>Store ID</th>    
                    <th>Guid</th>
                    <th>Status</th>
                    <th>Date Requested</th>   
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Request</h3>
            </div>
            <div class="card-body">
              <table id="example1"class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Server Product ID</th>
                    <th>Request Price</th>
                    <th>Store ID</th>    
                    <th>Guid</th>
                    <th>Status</th>
                    <th>Date Requested</th>     
                    <th>Action</th>                  
                </thead>
                <tfoot>
                  <tr>
                    <th>Server Product ID</th>
                    <th>Request Price</th>
                    <th>Store ID</th>    
                    <th>Guid</th>
                    <th>Status</th>
                    <th>Date Requested</th>     
                    <th>Action</th>    
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include_once('templates/webfooter.php');?>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/demo.js"></script>
<?php include 'modals/editcategorymodal.php';?>
<script>

function approveprice(id) {
    var r = confirm("Are you sure do you want to approve this price request ?");
    if (r == true) {
    $.ajax({  
    url:"actions/approve.php",  
    method:"POST",  
    data:{id:id},  
    success:function(data){  
      var table = $('#example').DataTable();
      $('#example').empty();
      table.destroy();
      LoadDatatable();
  
      var table1 = $('#example1').DataTable();
      $('#example1').empty();
      table1.destroy();
      LoadDatatable1();
      alert("Complete");
    }  
  });  
  } 

}
$( document ).ready(function() {
  LoadDatatable();
  LoadDatatable1();
});
function deleterequest(id) {
  var r = confirm("Are you sure do you want to delete request ?");
  if (r == true) {
    $.ajax({  
      url:"actions/disapprove.php",  
      method:"POST",  
      data:{id:id},  
      success:function(data){ 
        var table = $('#example').DataTable();
        $('#example').empty();
        table.destroy();
        LoadDatatable();
        
        var table1 = $('#example1').DataTable();
        $('#example1').empty();
        table1.destroy();
        LoadDatatable1();

        alert("Complete");
      }  
    });  
  } 
}
function LoadDatatable() {
  $("#example").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax": "dtserver/getpricerequest.php"
  });
}
function LoadDatatable1() {
  $("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax": "dtserver/getpricerequest1.php"
  });
}
</script>
</body>
</html>
    
