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
            <h1 class="m-0 text-dark">
              <?php
              include_once '../resources/functions.php';
              $query = query("SELECT OT.store_name as StoreName, OT.store_id as StoreID, OT.address as Address, OT.Barangay as Brgy, OT.municipality as Municipality, OT.province as Province, OT.postal_code as Postal FROM posrev.admin_outlets OT group by OT.store_name order by OT.store_id;");
              confirm($query);
              $row = fetch_array($query); 
              echo getstorename($_GET['viewoutletsales']) . "(". $row['Address'] , ", " , $row['Brgy'], ", " , selectmunicipality($row['Municipality']), ", " ,selectprovince($row['Province']) , " ", $row['Postal'].")";
              ?>          
              </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List of Outlets</li>
              <li class="breadcrumb-item active">Sales</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="totaltransactions">0</h3>
                <p>Total Transactions</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="totalusers">0</h3>
                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="totalgrosssales">0.00</h3>
                <p>Total Gross Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="totalnetsales">0.00</h3>
                <p>Total Net Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <a href="?outlets" class="btn btn-sm btn-warning btn-block mb-3 " type="button"><i class="fas fa-chevron-left mr-1"></i>View Outlets</a>
          </div>   
        </div>
      </div>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sales</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Date range:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="datepicker-pick">
                      <div class="input-group-prepend">
                          <button type="button" onclick="search();" class="btn btn-block btn-secondary btn-flat">Search</button>          
                     </div>
                    </div>              
                  </div>
                </div>             
              </div>
              <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Transaction Number</th>
                    <th>Gross Sales</th>
                    <th>Discount</th>
                    <th>Cash</th>
                    <th>Change</th>
                    <th>Amount Due</th>
                    <th>Transaction Type</th>
                    <th>Transaction Date</th>
                    <th>Option (View More)</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Transaction Number</th>
                    <th>Gross Sales</th>
                    <th>Discount</th>
                    <th>Cash</th>
                    <th>Change</th>
                    <th>Amount Due</th>
                    <th>Transaction Type</th>
                    <th>Transaction Date</th>
                    <th>Option (View More)</th>
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
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/demo.js"></script>
<?php include 'modals/viewsalesinfomodal.php';?>
<script>
  $(document).ready(function(){
    LoadDatatable();
    GetSums();
    updateConfig();
  });  
  function LoadDatatable() {
      var storeid = "<?php echo $_GET['viewoutletsales']; ?>";
      $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 50,
      "ajax": "dtserver/getstores.php?store="+ storeid
    });
  }

  function search() {
    var dateval = $("#datepicker-pick").val();
    var storeid = '<?php echo $_GET['viewoutletsales'];?>';

    var table = $('#example1').DataTable();
    $('#example1').empty();
    table.destroy();
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "ajax": "dtserver/getstoresales.php?dateval="+dateval+"&storeid="+storeid
    });
  }
  function GetSums() {
      var storeid = "<?php echo $_GET['viewoutletsales']; ?>";
      $.ajax({
      url: 'dtserver/getsums.php',
      type: 'post',
      data: {storeid:storeid},
      dataType: 'json',
      success:function(response){   
          $("#totaltransactions").empty(); 
          $("#totalusers").empty();
          $("#totalgrosssales").empty();
          $("#totalnetsales").empty();

          var transaction = response[0]['transactions']; 
          var totalusers = response[0]['users'];        
          var totalgross = response[0]['grosssales'];  
          var totalnet = response[0]['netsales'];  

          $('#totaltransactions').html(transaction);       
          $('#totalusers').html(totalusers);
          $('#totalgrosssales').html(totalgross);       
          $('#totalnetsales').html(totalnet);

      }
    })
  }
  function ViewProductInfo(id) {
  $.ajax({  
    url:"actions/viewtransactioninfo.php",  
    method:"post",  
    data:{id:id},  
    success:function(data){  
      $('#transaction_detail').html(data);  
      $('#modal-default').modal("show");
    }  
  });  
}
document.getElementById("btnPrint").onclick = function() {
    printElement(document.getElementById("printThis"));
    window.print();
}

function printElement(elem, append, delimiter) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    if (append !== true) {
        $printSection.innerHTML = "";
    }

    else if (append === true) {
        if (typeof(delimiter) === "string") {
            $printSection.innerHTML += delimiter;
        }
        else if (typeof(delimiter) === "object") {
            $printSection.appendChlid(delimiter);
        }
    }

    $printSection.appendChild(domClone);
}
  function updateConfig() {
    var options = {};
    options.timePicker = true;
    options.ranges = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    };
    $('#datepicker-pick').daterangepicker(options, function(start, end, label) {});      
  }
</script>
</body>
</html>
    
