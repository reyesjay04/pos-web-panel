<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Innovention | Store Sales</title>
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
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
              echo getstorename($_GET['store']) . "(". $row['Address'] , ", " , $row['Brgy'], ", " , selectmunicipality($row['Municipality']), ", " ,selectprovince($row['Province']) , " ", $row['Postal'].")";
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
                <h3 id="totaltransactions">0</h3>
                <p>Total Transactions</p>
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
                <h3 id="totalusers">0</h3>

                <p>Total Users</p>
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
                <h3 id="totalgrosssales">0.00</h3>

                <p>Total Gross Sales</p>
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
                <h3 id="totalnetsales">0.00</h3>

                <p>Total Net Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-md-3">
            <a href="?sales" class="btn btn-sm btn-warning btn-block mb-3 " type="button"><i class="fas fa-chevron-left mr-1"></i>Sales</a>
          </div>   
        </div>
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
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Transaction Type:</label>
                    <select class="form-control" id="transactiontype">
                      <option value="All">All</option>
                      <option value="Walk-In">Walk-In</option>
                      <option value="Registered">Registered</option>
                      <option value="GCash">GCash</option>
                      <option value="Grab">Grab</option>
                      <option value="Paymaya">Paymaya</option>
                      <option value="Lalafood">Lalafood</option>
                      <option value="Representation Expenses">Representation Expenses</option>
                      <option value="Food Panda">Food Panda</option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                </div> 
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
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Print all transaction type:</label>
                    <button type="button" class="btn btn-block btn-secondary btn-flat" onclick="printsales();" >Print</button>
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
<?php include 'modals/viewsalesinfomodal.php';?>
<script>
  $(document).ready(function(){
    LoadDatatable();
    GetSums();
    updateConfig();
  });  
  function LoadDatatable() {
      var storeid = "<?php echo $_GET['store']; ?>";
      $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 50,
      "ajax": "dtserver/getstores.php?store="+ storeid,
      dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Excel',
                title: 'StoreSalesExcel',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                titleAttr: 'PDF',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            }
        ]
    });
  }
  function search() {
    var dateval = $("#datepicker-pick").val();
    var storeid = '<?php echo $_GET['store'];?>';
    var typeoftransaction = $("#transactiontype").val();
    var table = $('#example1').DataTable();
    $('#example1').empty();
    table.destroy();
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "ajax": "dtserver/getstoresales.php?dateval="+dateval+"&storeid="+storeid+"&typeoftransaction="+typeoftransaction,
      dom: 'Blfrtip',
      buttons: [
          {
              extend: 'excelHtml5',
              text: '<i class="fas fa-file-excel"></i> Excel',
              title: 'StoreSalesExcel',
              titleAttr: 'Excel',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
              }
          },
          {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i> PDF',
              titleAttr: 'PDF',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
              }
          }
      ]
    });
  }
  function GetSums() {
      var storeid = "<?php echo $_GET['store']; ?>";
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
          if (totalgross == null) {totalgross = "0.00";}
          if (totalnet == null) {totalnet = "0.00";}
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

  function printsales() {
    var dateval = $("#datepicker-pick").val();
    var guid = '<?php echo $_SESSION['client_user_guid'];?>';
    $.ajax({  
    url:"print/printsales.php",  
    method:"post",  
    data:{dateval:dateval, guid:guid},  
      success:function(data){  
        var win = window.open('print/' + data);
        win.focus();
        // deletefile(data);
      }  
    }); 
  }
  function deletefile(filename) {
    $.ajax({
      url: 'actions/delpdf.php',
      type: 'post',
      data: {filename:filename}
    })
  }

  function GetTrasnsactionType() {
    var typeoftransaction = $("#transactiontype").val();
      var dateval = $("#datepicker-pick").val();
    var guid = '<?php echo $_SESSION['client_user_guid'];?>';
    $.ajax({
      url: 'dtserver/gettransactiontype.php',
      type: 'post',
      data: {typeoftransaction:typeoftransaction, dateval:dateval, guid:guid},
      success:function(data){
        var table = $('#example1').DataTable();
        $('#example1').empty();
        table.destroy();

      }
    })
  }
  function LoadDatatable2() {
      var storeid = "<?php echo $_GET['store']; ?>";
      $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 50,
      "ajax": "dtserver/getstores.php?store="+ storeid,
      dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Excel',
                title: 'StoreSalesExcel',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                titleAttr: 'PDF',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            }
        ]
    });
  }
</script>
</body>
</html>
    
