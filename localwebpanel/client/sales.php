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
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
            <h1 class="m-0 text-dark">List of outlets</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List of outlets</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Top 10 best selling product</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-store-tab" data-toggle="pill" href="#custom-tabs-four-store" role="tab" aria-controls="custom-tabs-four-store" aria-selected="false">Top Stores(based on sales)</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-products-tab" data-toggle="pill" href="#custom-tabs-four-products" role="tab" aria-controls="custom-tabs-four-products" aria-selected="false">Sales By Store/Product</a>
                </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-expenses-tab" data-toggle="pill" href="#custom-tabs-four-expenses" role="tab" aria-controls="custom-tabs-four-expenses" aria-selected="false">Expenses</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-overlay-tab">
                  <?php include 'tabs/topsellingtab.php';?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-store" role="tabpanel" aria-labelledby="custom-tabs-four-store-tab"> 
                  <?php include 'tabs/topstoretab.php';?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-products" role="tabpanel" aria-labelledby="custom-tabs-four-products-tab">   
                  <?php include 'tabs/productsalestab.php';?>
                </div>
                <div class="tab-pane fade show" id="custom-tabs-four-expenses" role="tabpanel" aria-labelledby="custom-tabs-four-overlay-tab">
                  <?php include 'tabs/expensetab.php';?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="content"> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recent Sales Log</h3>
            </div>
            
            <div class="card-body">
              <table id="example1" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Store Name(City)</th>
                    <th>Transaction #</th>
                    <th>Total</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include_once '../resources/functions.php';
                  $sql = "SELECT OT.store_name AS StoreName, OT.store_id AS StoreID, OT.address AS Address, OT.Barangay AS Brgy, OT.municipality AS Municipality, 
                                OT.province AS Province, OT.postal_code AS Postal,ADT.transaction_number, ADT.total,ADT.created_at AS DATE
                                FROM posrev.admin_daily_transaction_details ADT 
                                INNER JOIN posrev.admin_outlets OT ON ADT.store_id = OT.store_id 
                                WHERE ADT.guid = '".$_SESSION['client_user_guid']."' ORDER BY ADT.created_at DESC LIMIT 20;";
                  $query = query($sql);
                  confirm($query);
                  while ($row = fetch_array($query)) { 

                   
                  ?>  
                  <tr>
                    <td><?php echo $row['StoreName']; ?></td>
                    <td><?php echo $row['Address'] , ", " , $row['Brgy'], ", " , selectmunicipality($row['Municipality']), ", " ,selectprovince($row['Province']) , " ", $row['Postal'] ; ?></td>
                    <td><?php echo $row['transaction_number']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['DATE']; ?></td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
               
              </table>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
        <!-- /.row -->
    </section>

    <section class="content"> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Outlets</h3>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Store Name(City)</th>
                    <th>Current Sales</th>
                    <th>Branch Manager</th>
                    <th>Option (View More)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include_once '../resources/functions.php';
                  $sql = "SELECT OT.store_name as StoreName, OT.store_id as StoreID, OT.address as Address, OT.Barangay as Brgy, OT.municipality as Municipality, OT.province as Province, OT.postal_code as Postal, OT.manager_guid as Manager FROM posrev.admin_daily_transaction ADT LEFT JOIN posrev.admin_outlets OT ON ADT.store_id = OT.store_id WHERE ADT.guid = '".$_SESSION['client_user_guid']."' group by OT.store_name order by OT.store_id;";
                  $query = query($sql);
                  confirm($query);
                  while ($row = fetch_array($query)) { 

                    $sql1 = "SELECT SUM(grosssales) as GrossSales FROM posrev.admin_daily_transaction WHERE guid = '".$_SESSION['client_user_guid']."' AND DATE_FORMAT(created_at, '%Y-%m-%d') = DATE_FORMAT(curdate(), '%Y-%m-%d') AND store_id = ".$row['StoreID']." group by store_id";
                    $query1 = query($sql1);
                    $row1 = fetch_array($query1);
                    $Gross = $row1['GrossSales'];
                    $GrossTotal = ($Gross == '') ? '0.00' : $Gross;
                  ?>  
                  <tr>
                    <td><?php echo $row['StoreName']; ?></td>
                    <td><?php echo $row['Address'] , ", " , $row['Brgy'], ", " , selectmunicipality($row['Municipality']), ", " ,selectprovince($row['Province']) , " ", $row['Postal'] ; ?></td>
                    <td><?php echo  $GrossTotal ?></td>
                    <td>
                      <?php
                        $Manager1 = $row['Manager'];
                        $Manager = ($Manager1 == '') ? 'N/A' : $Manager1;
                        echo getmanager($Manager); 
                      ?>   
                    </td>
                    <td><button style="cursor:pointer; width: 160px;" name="view" onclick="ViewMore(this.id)"  id = "<?php echo $row['StoreID']; ?>" class="btn btn-block btn-info btn-xs">&nbsp;View More&nbsp;</button></td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Store Name(City)</th>
                    <th>Current Sales</th>
                    <th>Branch Manager</th>
                    <th>Option (View More)</th>
                  </tr>
                </tfoot>
              </table>
            </div>
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
</div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/demo.js"></script>

<script type="text/javascript">


  $(document).ready(function(){
    var table = $('#example1').DataTable({
      "responsive": true,
      "processing": true,
      "pageLength": 50,
      columnDefs: [
        { width: '20%', targets: 3}
      ],    
    }); 


    
   function updateConfig() {
      var options = {};
      var options2 = {};
      options.timePicker = true;
      options2.timePicker = true;
      options.ranges = {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      };
      options2.ranges = {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      };
      $('#datepicker-pick').daterangepicker(options, function(start, end, label) {});   
      $('#datepicker-pick2').daterangepicker(options2, function(start, end, label) {});   
      $('#datepicker-pick3').daterangepicker(options2, function(start, end, label) {});     
      $('#datepicker-pick4').daterangepicker(options2, function(start, end, label) {});   
    }

   function LoadStores() {
    $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    var session_var = "<?php echo $_SESSION['client_user_guid']; ?>";
    $.ajax({
      url: 'dtserver/getstoreids.php',
      type: 'post',
      data: {guid:session_var},
      dataType: 'json',
      success:function(response){     
        var len = response.length;
        $("#stores").empty();
        $("#stores").append("<option value='All'>All</option>")
        for( var i = 0; i<len; i++){
            var id = response[i]['id'];
            var name = response[i]['name'];          
            $("#stores").append("<option value='"+id+"'>"+name+"</option>");
            $("#stores2").append("<option value='"+id+"'>"+name+"</option>");   
            $("#stores3").append("<option value='"+id+"'>"+name+"</option>");     
            $("#stores4").append("<option value='"+id+"'>"+name+"</option>");  
        }
        //search(0);
        ApxChart(0);
      }
    });
  }
  // LoadDatatable2();
  updateConfig();
  LoadStores();
  ApxChart2(2);
  LoadProductIDS();

  })

  function LoadProductIDS() {
    $.ajax({
      url: 'dtserver/getproductids.php',
      type: 'post',
      dataType: 'json',
      success:function(response){     
        var len = response.length;
        for( var i = 0; i<len; i++){
            var id = response[i]['ID'];
            var name = response[i]['Name'];          
            $("#productids").append("<option value='"+id+"'>"+name+"</option>");     
        }
      }
    });
  }

  function ViewMore($storeID) {
    self.location = "?store="+ $storeID;
  }

</script>

</body>
</html>
    
