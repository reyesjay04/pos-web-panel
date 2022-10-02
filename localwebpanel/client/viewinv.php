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

            <h1 class="m-0 text-dark">
              <?php 
              include_once '../resources/functions.php';
              $query = query("SELECT OT.store_name as StoreName, OT.store_id as StoreID, OT.address as Address, OT.Barangay as Brgy, OT.municipality as Municipality, OT.province as Province, OT.postal_code as Postal FROM posrev.admin_outlets OT WHERE OT.user_guid = '".$_SESSION['client_user_guid']."' group by OT.store_name order by OT.store_id;");
              confirm($query);
              $row = fetch_array($query); 
              echo getstorename($_GET['viewinv']) . "(". $row['Address'] , ", " , $row['Brgy'], ", " , selectmunicipality($row['Municipality']), ", " ,selectprovince($row['Province']) , " ", $row['Postal'].")";

              ?>          
              </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List of outlets</li>
              <li class="breadcrumb-item active">Sales</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="totalinventories">0</h3>
                <p>Total Inventories</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="totalprimaryval">0</h3>

                <p>Total Primary Value</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="totalsecval">0.00</h3>

                <p>Total Secondary Value</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="totalnoofservings">0.00</h3>

                <p>Total Number of Servings</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
  

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sales</h3>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Product Ingredients</th>
                    <th>SKU</th>
                    <th>Primary</th>
                    <th>Secondary</th>
                    <th>No. of Servings</th>
                    <th>Status</th>
                    <th>Critical Limit</th>
                    <th>Date Synced</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Product Ingredients</th>
                    <th>SKU</th>
                    <th>Primary</th>
                    <th>Secondary</th>
                    <th>No. of Servings</th>
                    <th>Status</th>
                    <th>Critical Limit</th>
                    <th>Date Synced</th>
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
    GetSums();
  });  
  function LoadDatatable() {
      var storeid = "<?php echo $_GET['viewinv']; ?>";
      $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 50,
      "ajax": "dtserver/getinventory.php?viewinv="+ storeid
    });
  }
  function GetSums() {
      var invid = "<?php echo $_GET['viewinv']; ?>";
      $.ajax({
      url: 'dtserver/getsuminv.php',
      type: 'post',
      data: {invid:invid},
      dataType: 'json',
      success:function(response){   
          $("#totalinventories").empty(); 
          $("#totalprimaryval").empty();
          $("#totalsecval").empty();
          $("#totalnoofservings").empty();

          var invcount = response[0]['invcount']; 
          var primary = response[0]['primary'];        
          var secondary = response[0]['secondary'];  
          var servings = response[0]['servings'];  
          var aaaaa = parseFloat(servings);
          var totalserv = aaaaa.toFixed(2);

          $('#totalinventories').html(invcount);       
          $('#totalprimaryval').html(primary);
          $('#totalsecval').html(secondary);       
          $('#totalnoofservings').html(totalserv);
 
      }
    })
  }
//   function ViewProductInfo(id) {
//   $.ajax({  
//     url:"actions/viewtransactioninfo.php",  
//     method:"post",  
//     data:{id:id},  
//     success:function(data){  
//       $('#transaction_detail').html(data);  
//       $('#modal-default').modal("show");
//     }  
//   });  
// }
// document.getElementById("btnPrint").onclick = function() {
//     printElement(document.getElementById("printThis"));
//     window.print();
// }

// function printElement(elem, append, delimiter) {
//     var domClone = elem.cloneNode(true);

//     var $printSection = document.getElementById("printSection");

//     if (!$printSection) {
//         var $printSection = document.createElement("div");
//         $printSection.id = "printSection";
//         document.body.appendChild($printSection);
//     }

//     if (append !== true) {
//         $printSection.innerHTML = "";
//     }

//     else if (append === true) {
//         if (typeof(delimiter) === "string") {
//             $printSection.innerHTML += delimiter;
//         }
//         else if (typeof(delimiter) === "object") {
//             $printSection.appendChlid(delimiter);
//         }
//     }

//     $printSection.appendChild(domClone);
// }
</script>
</body>
</html>
    
