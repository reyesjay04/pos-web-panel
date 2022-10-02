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
<style>
  
#ApexChart {
  max-width: 100%;
  margin: 35px auto;
  min-height: 365px;margin-top: 0px;margin-bottom: 0px;
}
  
</style>
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
                  <a class="nav-link" id="custom-tabs-four-custom-tab" data-toggle="pill" href="#custom-tabs-four-custom" role="tab" aria-controls="custom-tabs-four-custom-tab" aria-selected="false">Custom Report</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-overlay-tab">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Store:</label>
                        <select id="stores" class="custom-select">
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
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
                              <button type="button" id="1" onclick="ApxChart1(this.id);" class="btn btn-block btn-secondary btn-flat">Search</button>          
                         </div>
                        </div>              
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="ApexChart" class=""></div>
                      <table id="sales_report" class="table table-striped table-bordered dt-responsive" style="width:100%">
                        <thead>
                          <tr>
                            <th>Store ID</th>
                            <th>Store Name</th>
                            <th>Product Name</th>
                            <th>Total Qty</th>
                            <th>Total Sales</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                      </table>
                      <script type="text/javascript">            
                        var optionsapex = {
                          series: [
                            {
                              name: 'Total Sales',
                              data: []
                            }, 
                            {
                              name: 'Total Quantity',
                              data: []
                            }
                          ],
                          chart: {
                            type: 'bar',
                            height: 350,
                            stacked: true,
                            toolbar: {
                              show: true
                            },
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
                              columnWidth: '55%',
                              endingShape: 'rounded'
                            },
                          },
                          xaxis: {
                            categories: [],
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
                <div class="tab-pane fade" id="custom-tabs-four-store" role="tabpanel" aria-labelledby="custom-tabs-four-store-tab"> 
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <!-- <label>Select Store:</label>
                        <select id="stores2" class="custom-select">
                          <option value="All">All</option>
                        </select> -->
                        <label>Select Client:</label>
                        <select id="clients" class="custom-select">
                          <option value="All">All</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Date range:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" class="form-control float-right" id="datepicker-pick2">
                          <div class="input-group-prepend">
                              <button type="button" id="3" onclick="ApxChart2(this.id);" class="btn btn-block btn-secondary btn-flat">Search</button>          
                         </div>
                        </div>              
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                       <div id="ApexChart2" class=""></div>
                       <table id="gross_sales" class="table table-striped table-bordered dt-responsive" style="width:100%">
                        <thead>
                          <tr>
                            <th>Store ID</th>
                            <th>Store Name</th>
                            <th>Gross Sales</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                      </table>
                      <script type="text/javascript">            
                        var optionsapex2 = {
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
                            // borderRadius: 8,
                            horizontal: false,
                          },
                        },
                        xaxis: {
                          categories: [],
                        },
                        legend: {
                          position: 'right',
                          offsetY: 40
                        },
                        fill: {
                          opacity: 1
                        }
                        };

                        var chartApex2 = new ApexCharts(document.querySelector("#ApexChart2"), optionsapex2);
                        chartApex2.render();    
                      </script>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-products" role="tabpanel" aria-labelledby="custom-tabs-four-products-tab">   
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Select Store:</label>
                        <select id="stores3" class="custom-select">
                          <option value='All'>All</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Select Product:</label>
                        <select id="productids" class="custom-select">
                        <option value="All">All</option>
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
                          <input type="text" class="form-control float-right" id="datepicker-pick3">
                          <div class="input-group-prepend">

                              <button type="button" id="4" onclick="ApxChart4(this.id)" class="btn btn-block btn-secondary btn-flat">Search</button>          
                         </div>
                        </div>              
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="ApexChart3" class=""></div>
                      <table id="sales_per_product" class="table table-striped table-bordered dt-responsive" style="width:100%">
                        <thead>
                          <tr>
                            <th>Store ID</th>
                            <th>Store Name</th>
                            <th>Product</th>
                            <th>Total Qty</th>
                            <th>Total Sales</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                      </table>
                      <script type="text/javascript">      
                        var optionsapex3 = {
                          series: [
                            {
                              name: 'Total Sales',
                              data: []
                            }, 
                            {
                              name: 'Total Quantity',
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

                        var chartApex3 = new ApexCharts(document.querySelector("#ApexChart3"), optionsapex3);
                        chartApex3.render();    
                      </script>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-custom" role="tabpanel" aria-labelledby="custom-tabs-four-custom-tab">   
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Select Store:</label>
                        <select id="stores4" class="custom-select">
                          <option value='All'>All</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Select Product:</label>
                        <select id="productids2" class="custom-select">
                          <option value='All'>All</option>
                        </select>
                      </div>
                    </div>                    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Date range:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" class="form-control float-right" id="datepicker-pick4">
                          
                        </div>              
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Transaction type:</label>
                        
                          <select id="typeoftransaction" class="custom-select">
                            <option value='All'>All</option>
                            <option value='All(Cash)'>All(Cash)</option>
                            <option value='All(Others)'>All(Others)</option>
                            <option value='Walk-In'>WALKIN</option>
                            <option value='Gcash'>Gcash</option>
                            <option value='Grab'>Grab</option>
                            <option value='Food Panda'>Food Panda</option>
                            <option value='Shopee Pay'>Shopee Pay</option>
                            <option value='RepExpense'>RepExpense</option>
                            <option value='Paymaya'>Paymaya</option>
                            <option value='Others'>Others</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Type Of Coupons:</label>
                        <div class="input-group">
                        <select id="coupon-type" class="custom-select">
                          <option value='All'>All</option>
                        </select>
                        <div class="input-group-prepend">
                              <button type="button" id="4" onclick="generateCustomreport(this.id)" class="btn btn-block btn-secondary btn-flat">Search</button>          
                         </div>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-info" style="float:right;margin:2px;" onclick="exportToExcel()"><i class="fas fa-file-excel"></i> Export To Excel</button>
                        <button class="btn btn-success" style="float:right;margin:2px;" onclick="exportToPdf()"><i class="fas fa-file-pdf"></i> Export To PDF</button>
                    </div>
                    <div class="col-sm-12">
                    <table id="tbl_custom_report" class="table table-striped table-bordered dt-responsive" style="width:100%">
                      <thead>
                        <tr>
                          <th>Store ID</th>
                          <th>Transaction #</th>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total</th>
                          <th>Transaction Type</th>
                          <th>Discount Type</th>
                          <th>Transaction Date</th>
                          <th>Read Date</th>
                        </tr>
                      </thead>
                      <!-- <tbody id='custom_report'>
                      </tbody> -->
                    
                    </table>
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
            <div class="card-header">
              <h3 class="card-title">Recent Sales Log</h3>
            </div>
            
            <div class="card-body">
              <table id="example2" class="table table-striped table-bordered dt-responsive" style="width:100%">
                <thead>
                  <tr>
                    <th>Store Name</th>
                    <th>Address</th>
                    <th>Transaction #</th>
                    <th>Total</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody id='sales_log'>
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
                    <th>Store Name</th>
                    <th>Franchisee Name</th>
                    <th>Status</th>
                    <th>Current Sales</th>
                    <th>Branch Manager</th>
                    <th>Option (View More)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include_once '../resources/functions.php';
                  $query = query("SELECT OT.store_name as StoreName, AU.user_fname as First, AU.user_lname as Last, OT.active as Status,  SUM(ADT.grosssales) as GrossSales,  OT.store_id as StoreID, OT.manager_guid as Manager,OT.user_guid FROM posrev.admin_daily_transaction ADT JOIN posrev.admin_outlets OT ON ADT.store_id = OT.store_id JOIN posrev.admin_user AU ON OT.user_guid = AU.user_guid group by OT.store_id;");
                  confirm($query);
                  while ($row = fetch_array($query)) { 

                    $sql1 = "SELECT case when SUM(grosssales) is null then 0 else SUM(grosssales) end GrossSales FROM posrev.admin_daily_transaction WHERE guid = '".$row['user_guid']."' AND DATE_FORMAT(created_at, '%Y-%m-%d') = DATE_FORMAT(curdate(), '%Y-%m-%d') AND store_id = ".$row['StoreID']." group by store_id";
                    $query1 = query($sql1);
                    if($query1 == '' || $query1 == null){
                      $row1 = fetch_array($query1);
                      $GrossTotal = ($row1['GrossSales'] == '' || $row1['GrossSales'] == null) ? '0.00' : $row1['GrossSales'];
                    }else{
                      $GrossTotal = '0.00';
                    }
                    
                    //$Gross = $row1['GrossSales'];
                    
                  ?>  
                  <tr>
                    <td><?php echo $row['StoreName']; ?></td>
                    <td><?php echo ucfirst($row['First']).' '.ucfirst($row['Last']); ?></td>
                    <td>
                      <?php
                        $Stats = ($row['Status'] == '2') ? 'POS ACTIVATED' : 'NOT ACTIVATED';
                        echo $Stats; 
                      ?>                 
                    </td>
                    <td><?php echo $GrossTotal; ?></td>
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
                    <th>Store Name</th>
                    <th>Franchisee Name</th>
                    <th>Status</th>
                    <th>Current Sales</th>          
                    <th>Branch Manager</th>
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
  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    legend: {
      position: 'bottom',
      display: true,
    },
    scales: {
      xAxes: [{
        stacked: true,
      }],
      yAxes: [{
        stacked: true
      }]
    }
  } 
  $(document).ready(function(){
    var table = $('#example1').DataTable({
      "responsive": true,
      "processing": true,
      "pageLength": 50,
      columnDefs: [
        { width: '20%', targets: 3}
      ],    
    }); 

    var table = $('#tbl_custom_report').DataTable({
      "responsive": true,
      "processing": true,
      searching: false,
      "pageLength": 50,
      columnDefs: [
        { width: '20%', targets: 3}
      ],
      "columns": [
        {
		    	"data": "store_name",
			  },
        {
		    	"data": "transaction_number",
			  },
			  {
		    	"data": "name",
			  },
			  
        {
		    	"data": "quantity",
			  },
        {
		    	"data": "price",
			  },
        {
		    	"data": "total",
			  },
        {
		    	"data": "Transaction_type",
			  },
        {
		    	"data": "discount_type",
			  },
        {
		    	"data": "Transaction_date",
			  },
        {
		    	"data": "Read Date",
			  },
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

  updateConfig();
  LoadStores();
  ApxChart2(2);
  LoadProductIDS();
  LoadClients();  
  loadCoupons();
  })

  function loadCoupons(){
    $.getJSON('dtserver/getCouponList.php', function(response) {
     
          for( var i = 0; i<response.length; i++){
              $('#coupon-type').append('<option value='+response[i].id+'>'+response[i].name+'</option>')   
          } 
      })
  }
  function getLatestSalesByStore(storeid) {
   	  var table = $('#example2').DataTable();
	   table.destroy();
	   $('#sales_log').empty()
      $.getJSON('dtserver/getRecentSalesByStore.php?storeid='+storeid, function(response) {
          for( var i = 0; i<response.length; i++){
          
              $('#sales_log').append('<tr>'
                                    +'<td>'+response[i].id+'</td>'
                                    +'<td>'+response[i].name+'</td>'
                                    +'<td>'+response[i].transaction_number+'</td>'
                                    +'<td>'+response[i].total+'</td>'
                                    +'<td>'+response[i].date
                                    +'</td></tr>')   
          } 
      })

      //var table = $('#example2').DataTable();
    
  }
  function LoadStores() {
    $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    $.ajax({
      url: 'dtserver/?getstoreids',
      type: 'post',
      dataType: 'json',
      success:function(response){     
          var len = response.length;
          $("#stores").empty();
          $("#stores").append("<option value='All'>All</option>")
          $("#stores4").empty();
          $("#stores4").append("<option value='All'>All</option>")     
          for( var i = 0; i<len; i++){
              var id = response[i]['id'];
              var name = response[i]['name'];          
              $("#stores").append("<option value='"+id+"'>"+name+"</option>");
              $("#stores2").append("<option value='"+id+"'>"+name+"</option>");   
              $("#stores3").append("<option value='"+id+"'>"+name+"</option>");     
              $("#stores4").append("<option value='"+id+"'>"+name+"</option>");   
          }
          // search(0);
          ApxChart1(0);
      }
    });
  }

  function LoadClients() {
    $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
   
    $.getJSON('dtserver/getListOfClients.php', function(response) {
      var len = response.length;
          $("#clients").empty();
          $("#clients").append("<option value='All'>All</option>")   
          for( var i = 0; i<len; i++){
              var id = response[i]['id'];
              var name = response[i]['fullname'];          
              $("#clients").append("<option value='"+id+"'>"+name+"</option>");   
              
          }
          // search(0);
          ApxChart1(0);
      })
  }

  function ApxChart1(btnid) {
    if (btnid == 1){
      $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    }
    var dateval = $("#datepicker-pick").val();
    var storeid = $("#stores").val();
    $.getJSON('dtserver/getapexchartsales.php?btnid='+btnid+'&dateval='+dateval+'&storeid='+storeid, function(response) {
      var len = response.length;
      var cat = [];
      var getqty = [];
      var gettotal = [];

      for(var i = 0; i<len; i++) {  
          var ProductNames = response[i]['BarGraphLabel'];
          var Qty = response[i]['x'];          
          var TotalSales = response[i]['y'];  

          cat.push(ProductNames);
          getqty.push(Qty);
          gettotal.push(TotalSales);
      }
      $("#loading").remove();  
      chartApex.updateOptions({
        xaxis: {
          categories: cat
        },
        series: [{
          name: 'Total Sales',
          data: gettotal
        }, {
          name: 'Total Quantity',
          data: getqty
        }],
      })
  })
    loadTop10BestSeller(btnid,dateval,storeid)
    getLatestSalesByStore(storeid)
}
function loadSalesPerProductStore(btnid,date,storeid,productid){
  	// $("#sales_report").destroy();
  	 $("#sales_per_product").DataTable({
       "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 50,
      "bInfo" : false,
      paging: false,
      searching: false,
      "bDestroy": true,
      "ajax": {url:'dtserver/getapexchartproductsales.php?btnid='+btnid+'&dateval='+date+'&storeid='+storeid+'&productid='+productid,dataSrc:""},
      "columns": [
        {
		    	"data": "Storeid",
			  },
        {
		    	"data": "StoreName",
			  },
        {
		    	"data": "Product",
			  },
			  {
		    	"data": "Qty",
			  },
			  {
		    	"data": "Sales",
			  },
        {
		    	"data": "Zread",
			  }
			  ],
      dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Excel',
                title: productid+' total sales in store',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                title: productid+' total sales in store',
                titleAttr: 'PDF',
                exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            }
        ]
    });
  }

  function loadTop10BestSeller(btnid,date,storeid){
  	// $("#sales_report").destroy();
  	 $("#sales_report").DataTable({
       "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 50,
      "bInfo" : false,
      paging: false,
      searching: false,
      "bDestroy": true,
      "ajax": {url:'dtserver/getapexchartsales.php?btnid='+btnid+'&dateval='+date+'&storeid='+storeid,dataSrc:""},
      "columns": [
        {
		    	"data": "storeid",
			  },
        {
		    	"data": "store_name",
			  },
      	{
		    	"data": "BarGraphLabel",
			  },
			  {
		    	"data": "x",
			  },
			  {
		    	"data": "y",
			  },
        {
		    	"data": "zreading",
			  }
			  ],
      dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Excel',
                title: 'Top 10 Best Sellers',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                title: 'Top 10 Best Sellers',
                titleAttr: 'PDF',
                exportOptions: {
                   columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            }
        ]
    });
  }

  function loadGrossSellingStore(btnid,date,clientid){
  	
  	 $("#gross_sales").DataTable({
       "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 50,
      "bInfo" : false,
      paging: false,
      searching: false,
      "bDestroy": true,
      "ajax": {url:'dtserver/getapexchartsales2.php?btnid='+btnid+'&dateval='+date+'&clientid='+clientid,dataSrc:""},
      "columns": [
        {
		    	"data": "Storeid",
			  },
      	{
		    	"data": "Name",
			  },
			  {
		    	"data": "Sales",
			  },
        {
		    	"data": "zreading",
			  }
			  ],
      dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Excel',
                title: 'Top stores',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                title: 'Top stores',
                titleAttr: 'PDF',
                exportOptions: {
                  columns: [ 0, 1, 2, 3 ]
                }
            }
        ]
    });
  }

  function ApxChart2(btnid) {
    if (btnid == 3){
        $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    }
    var dateval = $("#datepicker-pick2").val();
    // var storeid = $("#stores2").val();
    var clientid = $("#clients").val();
    $.getJSON('dtserver/getapexchartsales2.php?btnid='+btnid+'&dateval='+dateval+'&clientid='+clientid, function(response) {
      var len = response.length;
      var StoreName = [];
      var Sales = [];

      for(var i = 0; i<len; i++) {  

          StoreName.push(response[i]['Name']);
          Sales.push(response[i]['Sales']);

      }
      $("#loading").remove();  
      chartApex2.updateOptions({
        xaxis: {
          categories: StoreName
        },
        series: [{
          name: 'Total Sales',
          data: Sales
        }],
      })
  })

  loadGrossSellingStore(btnid,dateval,clientid)
  
  }
  function exportToExcel(){
    let dateval = $("#datepicker-pick4").val();
    let storeid = $("#stores4").val();
    let productid = $("#productids2 option:selected" ).text();
    // let sales_type = $("#typeofsales").val();
    let transaction_type = $("#typeoftransaction").val();
    let coupon_type = $("#coupon-type option:selected" ).text();
    
    var win = window.open(window.location.origin+'/admin/print/customReportExcel.php?dateval='+dateval+'&storeid='+storeid+'&productid='+productid
      +'&transaction_type='+transaction_type+'&coupon_type='+encodeURIComponent(coupon_type));
        win.focus();
  }
  function exportToPdf(){
    let dateval = $("#datepicker-pick4").val();
    let storeid = $("#stores4").val();
    let productid = $("#productids2 option:selected" ).text();
    // let sales_type = $("#typeofsales").val();
    let transaction_type = $("#typeoftransaction").val();
    let coupon_type = $("#coupon-type option:selected" ).text();
    
    // var win = window.open(window.location.origin+'/dgpos.app/admin/print/customReportPDF.php?dateval='+dateval+'&storeid='+storeid+'&productid='+productid
    //   +'&transaction_type='+transaction_type+'&coupon_type='+coupon_type);
    //     win.focus();
    $.ajax({  
    url:"print/customReportPDF.php",  
    method:"post",  
    data:{dateval:dateval, storeid:storeid, productid:productid,transaction_type:transaction_type,coupon_type:coupon_type},  
      success:function(data){  
        var win = window.open('print/' + data);
        win.focus();
        // deletefile(data);
      }  
    }); 
        
  }
  function generateCustomreport(btnid){
    if (btnid == 4){
        $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    }

      let dateval = $("#datepicker-pick4").val();
      let storeid = $("#stores4").val();
      let productid = $("#productids2 option:selected" ).text();
      // let sales_type = $("#typeofsales").val();
      let transaction_type = $("#typeoftransaction").val();
      let coupon_type = $("#coupon-type option:selected" ).text();
      
    $("#loading").remove();  
      
    $("#tbl_custom_report").DataTable({
       "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": false,
      "pageLength": 15,
      "bInfo" : true,
      paging: true,
      searching: false,
      "bDestroy": true,
      "ajax": {url:'dtserver/customReport.php?dateval='+dateval+'&storeid='+storeid+'&productid='+productid
      +'&transaction_type='+transaction_type+'&coupon_type='+encodeURIComponent(coupon_type),dataSrc:""},
      "columns": [
        {
		    	"data": "store_name",
			  },
        {
		    	"data": "transaction_number",
			  },
			  {
		    	"data": "name",
			  },
			  
        {
		    	"data": "quantity",
			  },
        {
		    	"data": "price",
			  },
        {
		    	"data": "total",
			  },
        {
		    	"data": "Transaction_type",
			  },
        {
		    	"data": "discount_type",
			  },
        {
		    	"data": "Transaction_date",
			  },
        {
		    	"data": "Read Date",
			  },
			  ],
    
    });

  }
  function ApxChart3(btnid) {
    if (btnid == 4){
        $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    }
      var dateval = $("#datepicker-pick3").val();
      var storeid = $("#stores3").val();
      var productid = $("#productids").val(); 

      $.getJSON('dtserver/getapexchartproductsales.php?btnid='+btnid+'&dateval='+dateval+'&storeid='+storeid+'&productid='+productid, function(response) {
        var len = response.length;
        var ZreadDate = [];
        var ProductSales = [];
        var ProductQty = [];

        for(var i = 0; i<len; i++) {  
            var Dt = response[i]['Zread'];
            var Sl = response[i]['Sales'];          
            var Qty = response[i]['Qty'];  

            ZreadDate.push(Dt);
            ProductSales.push(Sl);
            ProductQty.push(Qty);
        }
        
        $("#loading").remove();  
        chartApex3.updateOptions({
          xaxis: {
            categories: ZreadDate
          },
          series: [{
            name: 'Total Sales',
            data: ProductSales
          }, {
            name: 'Total Quantity',
            data: ProductQty
          }],
        })
    })          
  }
  function LoadProductIDS() {
    $.ajax({
      url: 'dtserver/?getproductids',
      type: 'post',
      dataType: 'json',
      success:function(response){     
        var len = response.length;
        for( var i = 0; i<len; i++){
            var id = response[i]['ID'];
            var name = response[i]['Name'];          
            $("#productids").append("<option value='"+id+"'>"+name+"</option>");     
            $("#productids2").append("<option value='"+id+"'>"+name+"</option>");   
        }
      }
    });
  }

  function ViewMore($storeID) {
    self.location = "?viewoutletsales="+ $storeID;
  }

  function ApxChart4(btnid) {
    if (btnid == 4){
        $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    }
      var dateval = $("#datepicker-pick3").val();
      var storeid = $("#stores3").val();
      // var productid = $("#productids2").val(); 
      var productid = $("#productids option:selected" ).text();
      
      $.getJSON('dtserver/getapexchartproductsales.php?btnid='+btnid+'&dateval='+dateval+'&storeid='+storeid+'&productid='+productid, function(response) {
        var len = response.length;
        var Store = [];
        var Product = [];
        var ProductSales = [];
        var ProductQty = [];
        var custom = [];

        for(var i = 0; i<len; i++) { 
            var store = response[i]['StoreName']; 
            var Dt = response[i]['Product'];
            var Sl = response[i]['Sales'];          
            var Qty = response[i]['Qty'];  
            
            Store.push(store);
            Product.push(Dt);
            ProductSales.push(Sl);
            ProductQty.push(Qty);

            if(storeid != 'All' && productid != 'All'){
               custom.push(store +'/'+Dt)
            }
        }

        
        let param = ''

        if(storeid == 'All' && productid == 'All'){
          param = Store
        }else if(storeid != 'All' && productid == 'All'){
          param = Product
        }else if(storeid == 'All' && productid != 'All'){
          param = Store
        }else if(storeid != 'All' && productid != 'All'){
          param = custom
        }
        
        
        $("#loading").remove();  
        chartApex3.updateOptions({
          xaxis: {
            categories: param
          },
          series: [{
            name: 'Total Sales',
            data: ProductSales
          }, {
            name: 'Total Quantity',
            data: ProductQty
          }],
        })
    })

    loadSalesPerProductStore(btnid,dateval,storeid,productid)          
  }
</script>
</body>
</html>
    
