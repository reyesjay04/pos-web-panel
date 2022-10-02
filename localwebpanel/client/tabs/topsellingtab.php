
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
            <button type="button" id="1" onclick="ApxChart(this.id);" class="btn btn-block btn-secondary btn-flat">Search</button>          
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
<script type="text/javascript">
    function ApxChart(btnid) {
    if (btnid == 1){
        $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    }
    var dateval = $("#datepicker-pick").val();
    var storeid = $("#stores").val();

    $.getJSON('dtserver/gettopselling.php?btnid='+btnid+'&dateval='+dateval+'&storeid='+storeid, function(response) {
        var len = response.length;
        var ProductNames = [];
        var Qty = [];
        var TotalSales = [];

        for(var i = 0; i<len; i++) {  
            var BG = response[i]['BarGraphLabel'];
            var QT = response[i]['Quantity'];          
            var TTL = response[i]['Total'];  

            ProductNames.push(BG);
            Qty.push(QT);
            TotalSales.push(TTL);
        }
            
        chartApex.updateOptions({
          xaxis: {
            categories: ProductNames
          },
          series: [{
            name: 'Total Sales',
            data: TotalSales
          }, {
            name: 'Total Quantity',
            data: Qty
          }],
        });
        $("#loading").remove(); 
    })

    loadTop10BestSeller(btnid,dateval,storeid)          
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
      "ajax": {url:'dtserver/gettopselling.php?btnid='+btnid+'&dateval='+date+'&storeid='+storeid,dataSrc:""},
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
		    	"data": "Quantity",
			  },
			  {
		    	"data": "Total",
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
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                title: 'Top 10 Best Sellers',
                titleAttr: 'PDF',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            }
        ]
    });
  }

  
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
    // var ctx = document.getElementById('barChart').getContext('2d');
    // var chart = new Chart(ctx, {
    //   type: 'bar',
    //   data: {
    //     labels: [],
    //     datasets: [
    //         {
    //           label               : 'Total Sales',
    //           backgroundColor     : 'rgb(130, 205, 255)',
    //           borderColor         : 'rgb(130, 205, 255)',
    //           pointRadius          : false,
    //           pointColor          : '#3b8bba',
    //           pointStrokeColor    : 'rgba(60,141,188,1)',
    //           pointHighlightFill  : '#fff',
    //           pointHighlightStroke: 'rgba(60,141,188,1)',
    //           data                : []
    //         },
    //         {
    //           label               : 'Total Quantity',
    //           backgroundColor     : 'rgb(255, 158, 179)',
    //           borderColor         : 'rgb(255, 158, 179)',
    //           pointRadius          : false,
    //           pointColor          : '#3b8bba',
    //           pointStrokeColor    : 'rgba(60,141,188,1)',
    //           pointHighlightFill  : '#fff',
    //           pointHighlightStroke: 'rgba(60,141,188,1)',
    //           data                : []
    //         },
    //       ]
    //   },
    //   options: barChartOptions
    // });  
// function search(btnid) {
//     if (btnid == 1){
//         $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
//     }
//     var dateval = $("#datepicker-pick").val();
//     var storeid = $("#stores").val();
//     $.ajax({
//       url: 'dtserver/gettopselling.php',
//       type: 'post',
//       data: {dateval:dateval,storeid:storeid,btnid:btnid},
//       dataType: 'json',
//       success:function(response){   
//         DeleteCanvas();
//         var len = response.length;
//         for(var i = 0; i<len; i++) {      
//           var ProductNames = response[i]['BarGraphLabel'];
//           var Qty = response[i]['Quantity'];          
//           var TotalSales = response[i]['Total'];  
//           addData(i,ProductNames,TotalSales,Qty);
//         }  
//         $("#loading").remove();   
//       }
//     })
//   }

//   function addData(position, label, data1, data2) {   
//     chart.data.labels[position] = label;
//     chart.data.datasets[0].data[position] = data1
//     chart.data.datasets[1].data[position] = data2;
//     chart.update();
//   }

//   function DeleteCanvas() {
//     $('#barChart').remove();
//     $('#appendchart').append('<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');
//     ctx = document.getElementById('barChart').getContext('2d');
//     chart = new Chart(ctx, {
//       type: 'bar',
//       data: {
//         labels: [],
//         datasets: [
//             {
//               label               : 'Total Sales',
//               backgroundColor     : 'rgb(130, 205, 255)',
//               borderColor         : 'rgb(130, 205, 255)',
//               pointRadius          : false,
//               pointColor          : '#3b8bba',
//               pointStrokeColor    : 'rgba(60,141,188,1)',
//               pointHighlightFill  : '#fff',
//               pointHighlightStroke: 'rgba(60,141,188,1)',
//               data                : []
//             },
//             {
//               label               : 'Total Quantity',
//               backgroundColor     : 'rgb(255, 158, 179)',
//               borderColor         : 'rgb(255, 158, 179)',
//               pointRadius          : false,
//               pointColor          : '#3b8bba',
//               pointStrokeColor    : 'rgba(60,141,188,1)',
//               pointHighlightFill  : '#fff',
//               pointHighlightStroke: 'rgba(60,141,188,1)',
//               data                : []
//             }
//           ]
//       },
//       options: barChartOptions
//     });
//   }
</script>