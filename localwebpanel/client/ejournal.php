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
            <h1 class="m-0 text-dark">EJournal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">EJournal</li>
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
              <h3 class="card-title">Filter</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4 pb-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="stores">Select Store</label>
                    </div>
                    <select id="stores" class="custom-select">
                    </select>
                  </div>
                </div>

                <div class="col-sm-4 pb-3">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="datepicker-pick">
                  </div>              
                </div>
                <div class="col-sm-4 pb-3">
                  <div class="input-group"> 
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="transactiontype">Transaction type</label>
                    </div>
                    <select id="transactiontype" class="custom-select">
                      <option value="All(Cash)">All(Cash)</option>
                      <option value="All(Others)">All(Others)</option>
                      <option value="Walk-In">Walk-In</option>
                      <option value="Registered">Registered</option>
                      <option value="GCash">GCash</option>
                      <option value="Grab">Grab</option>
                      <option value="Paymaya">Paymaya</option>
                      <option value="Lalafood">Lalafood</option>
                      <option value="Representation Expenses">Representation Expenses</option>
                      <option value="Food panda">Food panda</option>
                      <option value="Lalafood">Others</option>                     
                    </select>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" onclick="search()" type="button">Search</button>
                    </div>
                  </div>
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
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i>Sales</h3>
                <a href="#" onclick="generateEjournal();">Download as PDF file</a>
              </div>
            </div>
          <div class="card-body">
            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Trasaction No.</th>
                  <th>Gross Sales</th>
                  <th>Discount</th>
                  <th>Cash</th>
                  <th>Change</th>
                  <th>Amount Due</th>
                  <th>Type</th>
                  <th>Type</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Trasaction No.</th>
                  <th>Gross Sales</th>
                  <th>Discount</th>
                  <th>Cash</th>
                  <th>Change</th>
                  <th>Amount Due</th>
                  <th>Type</th>
                  <th>Type</th>
                </tr>
              </tfoot>
            </table>
          </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
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

<script type="text/javascript">

  $(document).ready(function(){
 
    var table = $('#example').DataTable({
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
    }

  updateConfig();
  LoadStores();
  })

  function LoadStores() {
    $("#stores").append("<option value=''>Fetching</option>")
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
        }
      }
    });
  }

  function search() {
    var storeid = $("#stores").val();
    var transactiontype =  $("#transactiontype").val();
    var daterange = $("#datepicker-pick").val();
     var table = $('#example').DataTable();
    $('#example').empty();
    table.destroy();
    $("#example").DataTable({
      "ajax": "data.json",
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "ajax": "dtserver/getejournalsales.php?storeid=" + storeid + "&transactiontype=" + transactiontype + "&daterange=" + daterange,
      "order": [[ 7, "desc" ]]
    });
  }

  function generateEjournal() {

    var loc = window.location.pathname;
    var dir = loc.substring(0, loc.lastIndexOf('/'));
    var storeid = $("#stores").val();
    var transactiontype = $("#transactiontype").val();
    var daterange = $("#datepicker-pick").val();
    $.ajax({
      url: 'actions/generatetextfile.php',
      type: 'post',
      data: {storeid:storeid, transactiontype:transactiontype, daterange:daterange},
      success:function(response){     
        var a = document.createElement('a');
        a.href = dir + "/newfile.txt";
        a.download = 'download';
        a.click();
      }
    });
  }

</script>


</body>
</html>
    
