<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label>Select Store:</label>
      <select id="stores2" class="custom-select">
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
    <div id="ApexChart2"></div>
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

      var chartApex2 = new ApexCharts(document.querySelector("#ApexChart2"), optionsapex2);
      chartApex2.render();    
    </script>
  </div>
</div>
<script type="text/javascript">

  function ApxChart2(btnid) {
    if (btnid == 3){
        $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    }
    var dateval = $("#datepicker-pick2").val();
    var storeid = $("#stores2").val();

    $.getJSON('dtserver/getsales.php?btnid='+btnid+'&dateval='+dateval+'&storeid='+storeid, function(response) {

        var len = response.length;
        var StoreName = [];
        var TotalSales = [];

        for(var i = 0; i<len; i++) {  
            var NM = response[i]['Name'];
            var SL = response[i]['Sales'];           

            StoreName.push(NM);
            TotalSales.push(SL);
        }
            
        chartApex2.updateOptions({
          xaxis: {
            categories: StoreName
          },
          series: [{
            name: 'Total Sales',
            data: TotalSales
          }],
        });
        $("#loading").remove(); 
    }) 

    loadGrossSellingStore(btnid,dateval,storeid)

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
     "ajax": {url:'dtserver/getsales.php?btnid='+btnid+'&dateval='+date+'&storeid='+clientid,dataSrc:""},
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

</script>
<!-- <script type="text/javascript">
  var ctx2 = document.getElementById('barChart2').getContext('2d');
  var chart2 = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: [],
    datasets: [
        {
          label               : 'Total Sales',
          backgroundColor     : 'rgb(83, 123, 196)',
          borderColor         : 'rgb(83, 123, 196)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : []
        },
      ]
  },
  options: barChartOptions
});
function GetStoreSales(btnid) {
    if (btnid == 3){
        $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
    }
    var dateval = $("#datepicker-pick2").val();
    var storeid = $("#stores2").val();
    $.ajax({
      url: 'dtserver/getsales.php',
      type: 'post',
      data: {dateval:dateval,storeid:storeid,btnid:btnid},
      dataType: 'json',
      success:function(response){   
        DeleteCanvas2();
        var len = response.length;
        for(var i = 0; i<len; i++) {      
          var StoreName = response[i]['Name'];       
          var TotalSales = response[i]['Sales'];  
          addData2(i,StoreName,TotalSales);
        }  
        $("#loading").remove();   
      }
    })

  }

  function addData2(position, label, data1) {   
    chart2.data.labels[position] = label;
    chart2.data.datasets[0].data[position] = data1
    chart2.update();
  }
  function DeleteCanvas2() {
    $('#barChart2').remove();
    $('#appendchart2').append('<canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');
    ctx2 = document.getElementById('barChart2').getContext('2d');
    chart2 = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: [],
        datasets: [
            {
              label               : 'Total Sales',
              backgroundColor     : 'rgb(83, 123, 196)',
              borderColor         : 'rgb(83, 123, 196)',
              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : []
            },
          ]
      },
      options: barChartOptions
    });
  }
</script> -->