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
  <style>
    .table-filter-container {
          text-align: right;
      }
  </style>
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

            <h1 class="m-0 text-dark">
              <?php 
              include_once '../resources/functions.php';
              $query = query("SELECT OT.store_name as StoreName, OT.store_id as StoreID, OT.address as Address, OT.Barangay as Brgy, OT.municipality as Municipality, OT.province as Province, OT.postal_code as Postal FROM posrev.admin_outlets OT WHERE OT.user_guid = '".$_SESSION['client_user_guid']."' group by OT.store_name order by OT.store_id;");
              confirm($query);
              $row = fetch_array($query); 
              echo getstorename($_GET['syslogs']) . "(". $row['Address'] , ", " , $row['Brgy'], ", " , selectmunicipality($row['Municipality']), ", " ,selectprovince($row['Province']) , " ", $row['Postal'].")";

              ?>          
              </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">System Logs</li>
              <li class="breadcrumb-item active">Store Logs</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">System Logs</h3>
            </div>
            
              <p id="table-filter" style="display:none">
                  Filter: 
                  <select>
                  <option value="">All</option>
                  <option>LOGOUT</option>
                  <option>LOGIN</option>
                  <option>BG-1</option>
                  <option>MENU FORM</option>
                  <option>Z-READ</option>
                  <option>TRANSACTION</option>
                  <option>X-READ</option>
                  <option>CLOUD SYNC</option>
                  <option>STOCK ENTRY</option>
                  <option>STOCK REMOVAL</option>
                  <option>ERROR</option>
                  <option>NEW EXPENSE</option>
                  <option>UPDATE PRICE CHANGE</option>
                  </select>
            </p>
          
            <div class="card-body">
              <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Log ID</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Log Date</th>         
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Log ID</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Log Date</th>   
                  </tr>
                </tfoot>
              </table>
              <!-- <label class="col-sm-1">Total: <span id="total"></span></label>           -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
        <!-- /.row -->
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
<script src="../plugins/datatables/sum().js"></script>
<?php include 'modals/viewsalesinfomodal.php';?>
<script>
  $(document).ready(function(){
    LoadDatatable();
    // GetSums();
  });  
  function LoadDatatable() {
      var storeid = "<?php echo $_GET['syslogs']; ?>";
    //   $("#example1").DataTable({
    //   "responsive": true,
    //   "autoWidth": false,
    //   "processing": true,
    //   "serverSide": true,
    //   "pageLength": 50,
    //   searching: false,
    //   "ajax": "dtserver/getstorelogs.php?syslogs="+ storeid,
    //   "order": [[ 3, "desc" ]]
    // });

     var table = $('#example1').DataTable({
      "ajax": "dtserver/getstorelogs.php?syslogs="+ storeid,
      "order": [[ 3, "desc" ]],
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 100,
      "lengthChange": false,
       dom: 'lr<"table-filter-container">tip',
       initComplete: function(settings){
          var api = new $.fn.dataTable.Api( settings );
          $('.table-filter-container', api.table().container()).append(
             $('#table-filter').detach().show()
          );
          
          $('#table-filter select').on('change', function(){
             table.search(this.value).draw();   
          });       
       }
    });
  }
</script>
</body>
</html>
    
