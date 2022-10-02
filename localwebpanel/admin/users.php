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
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
            <h1 class="m-0 text-dark">Manage All Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage All Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
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
            </div><!-- /.card-tools -->
          </div><!-- /.card-header -->
          <div class="card-body">
            <button class="btn btn-sm btn-secondary btn-block mb-3 " data-toggle="modal" data-target="#modal-add-user" type="button">Create Account</button>
          </div>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-12">
        <div class="card">
        <div class="card-header">
          <h3 class="card-title">Clients</h3>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-1">Roles</label>
            <div class="col-sm-2">
              <select class="form-control" onchange="select_role()" id="Roles">
                <option value="Admin">Administrators</option>
                <option value="Manager">Manager</option>
                <option value="Users">Franchisee</option>
                <option value="ActiveUsers">Active Users</option>
              </select>
            </div>
          </div>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>lastName</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Full Name</th>
                  <th>lastName</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
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
          <h3 class="card-title">Not activated accounts</h3>
        </div>
          <div class="card-body">
            <table id="example2" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>lastName</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Full Name</th>
                  <th>lastName</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once('templates/webfooter.php');?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
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
<script>
  $(document).ready(function(){
    LoadDatatable('Admin');
    LoadDatatableNotActive();
  });  
  // function Send($id) {
  //   var url = "view_outlets.php?id=" + $id;
  //   window.location.href = url;
  // };


  function select_role() {

    var e = document.getElementById("Roles");
    var strUser = e.options[e.selectedIndex].value;
    var table = $('#example1').DataTable();
    $('#example1').empty();

    table.destroy();
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 10,
      "ajax": "dtserver/getadminuser.php?role=" + strUser,
      "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return data + ' ' + row[1];
                },
                "targets": 0
            },
            { "visible": false,  "targets": [ 1 ] }
        ]
    });
  }
  function LoadDatatable($role) {
      $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "ajax": "dtserver/getadminuser.php?role="+$role ,
      "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return data + ' ' + row[1];
                },
                "targets": 0
            },
            { "visible": false,  "targets": [ 1 ] }
        ]
    });
  }
  function LoadDatatableNotActive() {
      $("#example2").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "ajax": "dtserver/getnotactiveuser.php" ,
      "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return data + ' ' + row[1];
                },
                "targets": 0
            },
            { "visible": false,  "targets": [ 1 ] }
        ]
    });
  }
  function edituser(id) {
    var clientid = id;
    $.ajax({  
      url:"actions/edituser.php",  
      method:"post",  
      data:{id:id},  
      success:function(data){  
        $('#user_detail').html(data);  
        $('#modal-default').modal("show");  
      }  
    });  
  }
  function deleteuser(id) {
    var r = confirm("Are you sure do you want to delete this user ?");
    if (r == true) {
      $.ajax({  
        url:"actions/deleteuser.php",  
        method:"POST",  
        data:{id:id},  
        success:function(data){ 
            if(data == 'Unsuccessful') {
              alert('Administrator accounts cannot be deleted!')
            } else if (data == 'Success') {
              var table = $('#example1').DataTable();
              $('#example1').empty();
              table.destroy();
              LoadDatatable('Users');
              alert("Deleted successfully!");
            } else {
              alert("Account Has Outlets");
            }
        }  
      });  
    } 
  }
function showpass() {
  var x = document.getElementById("showpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function approve(id) {
  $.ajax({  
    url:"actions/approveuser.php",  
    method:"POST",  
    data:{id:id},  
    success:function(data){ 
        var table = $('#example2').DataTable();
        $('#example2').empty();
        table.destroy();
        LoadDatatableNotActive();
        alert("Approved!");
    }  
  }); 
}
function decline(id) {
  var r = confirm("Are you sure do you want to decline this user ?");
  if (r == true) {
    $.ajax({  
      url:"actions/declineuser.php",  
      method:"POST",  
      data:{id:id},  
      success:function(data){ 
        var table = $('#example2').DataTable();
        $('#example2').empty();
        table.destroy();
        LoadDatatableNotActive();
      }  
    });  
  } 
}
function viewclientstore(id) {
  $.ajax({  
    url:"dtserver/viewclientstore.php",  
    method:"post",  
    data:{id:id},  
    success:function(data){  
      $('#view-store').html(data);  
      $('#modal-default-store').modal("show");
    }  
  });  
}
</script>
<?php include_once('modals/viewclientstore.php');?>
<?php include_once('modals/editusermodal.php');?>
<?php include_once('modals/addusermodal.php');?>
</body>
</html>
    
