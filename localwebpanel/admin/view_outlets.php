<?php
include_once '../resources/functions.php';
$sql = "SELECT * FROM admin_user WHERE user_guid = '".$_GET['gtoid']."'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$firstname = $row['user_fname'];
$lastname = $row['user_lname'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Innovention</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include_once('templates/nav.php');?>
<?php include_once('templates/sidenav.php');?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Client Outlets (<?php echo  $firstname . ' ' . $lastname?>)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="?outlets">Outlets</a></li>
              <li class="breadcrumb-item active">View Outlets</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
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
              <button class="btn btn-sm btn-secondary btn-block mb-3 " data-toggle="modal" data-target="#modal-default" type="button">Add Outlet</button>
            </div>
          </div>
        </div>
      </div>  
      <div class="row">
        <div class="col-md-3">
          <a href="?outlets" class="btn btn-sm btn-warning btn-block mb-3 " type="button"><i class="fas fa-chevron-left mr-1"></i>Outlets</a>
        </div>       
      </div>
	    <div class="row">
	      <div class="col-md-12">
	        <div class="card">
	          <div class="card-header">
	            <h3 class="card-title">Clients</h3>
	          </div>
	          <div class="card-body">
	            <table id="example1" class="table table-bordered table-striped">
	              <thead>
	                <tr>
                    <th>Store Name</th>
                    <th>Address</th>
                    <th>Location Name</th>
                    <th>Postal Code</th>
                    <th>Status</th>
                    <th>Action</th>
	                </tr>
	              </thead>
	              <tfoot>
	              <tr>
                  <th>Store ID</th>
                  <th>Address</th>
            		  <th>Location Name</th>
                  <th>Postal Code</th>
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
  </div>
  <?php include_once('templates/webfooter.php')?>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script>
function ViewSales(id) {
  var url = "view_sales.php?id=" + $id;
  window.location.href = url;
}

function addoutlet() {
  var brand = $('#brands').val();
  alert(brand);
}

$(document).ready(function(){
  LoadDatatable();
});  
function LoadDatatable() {
  var toencode = "<?php echo $_GET['gtoid']?>";
  var table = $('#example1').DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "ajax": "dtserver/clientoutlets.php?id=<?php echo $_GET['gtoid'];?>"
  });
};
function Activate($id) {
  $.ajax({
    url: "actoutlet/",
    method: "POST",
    data:{id:$id}, 
    success: function(data){
      alert("Success!");  
      var table = $('#example1').DataTable();
      $('#example1').empty();
      table.destroy();
      LoadDatatable();
    }
  });
};
</script>
<?php include_once('modals/addoutletmodal.php');?>
</body>
</html>
