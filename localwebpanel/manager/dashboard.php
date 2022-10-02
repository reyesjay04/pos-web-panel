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
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
                  <h4 id="totalsalesalloutlet">&#8369;0.00</h4>
                  <p>Total Sales(From all branches)</p>
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
                  <h4 id="totaltransactionsalloutlet">0</h4>
                  <p>Total Transactions(From all branches)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h4 id="announcement">Fetching..</h4>
                  <p>Announcement/Message</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h4 id="feedback" onclick="feedback();">Fetching..</h4>
                  <p>Feedback</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-lg-12 col-12">
              <div class="card" id="appendload">
                <div class="card-header ui-sortable-handle">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>Top Store based on sales
                  </h3>
                </div>
                <div class="card-body">
                  <div class="col-sm-12">
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
                            <button type="button" id="1" onclick="ApxChart(this.id) ;" class="btn btn-block btn-secondary btn-flat">Search</button>          
                       </div>
                      </div>              
                    </div>
                  </div>
                  <div id="ApexChart">
                  </div>  
                 <script type="text/javascript">      
                    var optionsapex = {
                      series: [
                        {
                          name: 'Total Sales',
                          data: []
                        }
                      ],
                      chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                          show: true
                        },
                        zoom: {
                          enabled: true
                        }
                      },
                    responsive: [{
                      breakpoint: 480,
                      options: {
                        legend: {
                          position: 'bottom',
                          offsetX: -10,
                          offsetY: 0
                        }
                      }
                    }],
                    plotOptions: {
                      bar: {
                        horizontal: false,
                      },
                    },
                    xaxis: {
                      categories: [],
                    },
                    legend: {
                      position: 'bottom'
                    },
                    fill: {
                      opacity: 1
                    }
                    };

                    var chartApex = new ApexCharts(document.querySelector("#ApexChart"), optionsapex);
                    chartApex.render();  
                  </script>
                </div>
              </div>
            </div>            
          </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bug mr-1"></i>Logs</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th>Store</th>
                      <th>LogID</th>
                      <th>Log Type</th>
                      <th>Description</th>
                      <th>Date/Time</th>
                      <th>Zreading</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include('../resources/functions.php');
                    if ($StoreIDS == "") {
                      $StoreIDS = 0;
                    } 
                    $sql = "SELECT log_store, loc_systemlog_id, log_type, log_description, log_date_time, zreading FROM posrev.admin_system_logs WHERE log_store IN ($StoreIDS) ORDER BY log_date_time DESC LIMIT 20";
                    $query = query($sql);
                    confirm($query);
                    while ($row = fetch_array($query)) { 
                        $storename = "FBW-".$row['log_store'];  
                        $logid = $row['loc_systemlog_id'];
                        $type = $row['log_type'];
                        $desc = $row['log_description'];  
                        $datetime = $row['log_date_time'];
                        $Zreading = $row['zreading'];
                        echo '<tr><td>'.$storename.'</td><td>'.$logid.'</td><td>'.$type.'</td><td>'.$desc.'</td><td>'.$datetime.'</td><td>'. $Zreading.'</td></tr>';  
                    }   
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Store</th>
                      <th>LogID</th>
                      <th>Log Type</th>
                      <th>Description</th>
                      <th>Date/Time</th>
                      <th>Zreading</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
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
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/demo.js"></script>

<script type="text/javascript">

function ApxChart(id) {
    $("#appendload").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");

    var storeid = "<?php echo $StoreIDS; ?>";
    var dateval = $("#datepicker-pick").val();

    $.getJSON('dtserver/gettopstoredash.php?id='+id+'&dateval='+dateval+'&storeid='+storeid, function(response) {
        var len = response.length;

        var ProductNames = [];
        var TotalSales = [];

        for(var i = 0; i<len; i++) {  
            var BG = response[i]['BarGraphLabel'];      
            var Total = response[i]['Total'];  

            ProductNames.push(BG);
            TotalSales.push(Total);
        }       
       
        chartApex.updateOptions({
          xaxis: {
            categories: ProductNames
          },
          series: [{
            name: 'Total Sales',
            data: TotalSales
          }],
        });
        $("#loading").remove();  
    })
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
$(document).ready(function(){ 
  GetSums();
  ApxChart(0);
  updateConfig();
  var table = $('#example1').DataTable({
      "responsive": true,
      "pageLength": 20,
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "searching": false,
      "bAutoWidth": false
  });
});

function feedback() {
  window.open('mailto:aiolosinnovativesolutions@gmail.com?subject=subject&body=body');
}
function GetSums() {
    var storeid = "<?php echo $StoreIDS; ?>";
    $.ajax({
    url: 'dtserver/getsumdash.php',
    type: 'post',
    data: {"storeid":storeid},
    dataType: 'json',
    success:function(response){   

        $("#totalsalesalloutlet").empty(); 
        $("#totaltransactionsalloutlet").empty();
        $("#announcement").empty();

        var ttlsales = response[0]['Sales']; 
        var ttltran = response[0]['Transactions'];        
        var announcement = response[0]['Announcements'];  
        var announce = "";
        var n = 0;
        if (announcement !== null) {
          n  = announcement.length;
        } else {
          n = 0;
        }
        if (n == 0) {
          announce = "No Announcement";
        } else if (n > 15) {
          announce = announcement.substring(0, 15) + '...';
        } else {
          announce = announcement;
        }

        if (ttlsales == null) {
          ttlsales = "0.00";
        } 
    
        $('#totalsalesalloutlet').html("&#8369;"+ttlsales);       
        $('#totaltransactionsalloutlet').html(ttltran);
        $('#announcement').html(announce);    
        $('#feedback').html("Click Here");  
         

    }
  })
}

</script>
</body>
</html>
    
