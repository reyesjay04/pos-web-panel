          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Select Store:</label>
                <select id="stores4" class="custom-select">
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
                  <input type="text" class="form-control float-right" id="datepicker-pick4">
                  <div class="input-group-prepend">
                      <button type="button"  onclick="ApxChart4();" class="btn btn-block btn-secondary btn-flat">Search</button>          
                 </div>
                </div>              
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div id="ApexChart4" class=""></div>
                <script type="text/javascript">      
                var optionsapex4 = {
                  series: [
                    {
                      name: 'Total Expenses',
                      data: []
                    }
                  ],
                  chart: {
                    type: 'bar',
                    height: 350,
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

                var chartApex4 = new ApexCharts(document.querySelector("#ApexChart4"), optionsapex3);
                chartApex4.render();    
              </script>                 
            </div>
          </div>
          <div class="row">
          <div class="col-md-12">
            <div class="card-body p-0">
              <table id="example4" class="table table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>Total Expenses</th>
                    <th>Date Created</th>
                  </tr>
                </thead>
                <tbody id="tbody-expenses">  
                </tbody>
              </table>
            </div>      
          </div>
        </div> 
    <script type="text/javascript">

    function ApxChart4(btnid) {
      if (btnid == 4){
          $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
      }
      var dateval = $("#datepicker-pick4").val();
      var storeid = $("#stores4").val();

        $.getJSON('dtserver/getexpenses.php?dateval='+dateval+'&storeid='+storeid, function(response) {

          var len = response.length;
          var ZreadDate = [];
          var Expenses = [];

          for(var i = 0; i<len; i++) {  
              var Zd = response[i]['ZreadDate'];
              var Ex = response[i]['Expenses'];          

              ZreadDate.push(Zd);
              Expenses.push(Ex);

          }
          
          $("#loading").remove();  
          chartApex4.updateOptions({
            xaxis: {
              categories: ZreadDate
            },
            series: [{
              name: 'Total Expenses',
              data: Expenses
            }],
          })
      })          
    }
    </script> 
       <!--  <script type="text/javascript">
          var barChartOptions4 = {
              responsive              : true,
              maintainAspectRatio     : false,
              legend: {
                position: 'top',
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
          var ctx4 = document.getElementById('barChart4').getContext('2d');
          var chart4 = new Chart(ctx4, {
            type: 'bar',
            data: {
              labels: [],
              datasets: [
                  {
                    label               : 'Total Expenses',
                    backgroundColor     : 'rgb(246, 112, 25)',
                    borderColor         : 'rgb(246, 112, 25)',
                    pointRadius         : true,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : []
                  },            
                ]
            },
            options: barChartOptions4
          });
          function GetExpenses() {
            $("#tbody-expenses").empty();
            $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
            
            var dateval = $("#datepicker-pick4").val();
            var storeid = $("#stores4").val();

            $.ajax({
              url: 'dtserver/getexpenses.php',
              type: 'post',
              data: {dateval:dateval,storeid:storeid},
              dataType: 'json',
              success:function(response){   
       
                DeleteCanvas4();
                var len = response.length;
                for(var i = 0; i<len; i++) {      
                  var ZreadDate = response[i]['ZreadDate'];       
                  var Expenses = response[i]['Expenses'];  
                  addData4(i,ZreadDate,Expenses);
                  $("#tbody-expenses").append('<tr><td>'+Expenses+'</td><td>'+ZreadDate+'</td></tr>');
                }  

                // LoadDatatable2();
                $("#loading").remove();   
              }
            })
          }
          function addData4(position, label, data1) {   
            chart4.data.labels[position] = label;
            chart4.data.datasets[0].data[position] = data1
            chart4.update();
          }
          function DeleteCanvas4() {
            $('#barChart4').remove();
            $('#appendchart4').append('<canvas id="barChart4" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>');
            ctx4 = document.getElementById('barChart4').getContext('2d');
            chart4 = new Chart(ctx4, {
              type: 'bar',
              data: {
                labels: [],
                datasets: [
                  {
                    label               : 'Total Expenses',
                    backgroundColor     : 'rgb(246, 112, 25)',
                    borderColor         : 'rgb(246, 112, 25)',
                    pointRadius         : true,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : []
                  },            
                  ]
              },
              options: barChartOptions4
            });
          }  

          function LoadExpenses() {
            $.ajax({
              url: 'dtserver/getexpensedetails.php',
              type: 'post',
              data: {dateval:dateval,storeid:storeid},
              dataType: 'json',
              success:function(response){   
                DeleteCanvas4();
                var len = response.length;
                for(var i = 0; i<len; i++) {      
                  var ZreadDate = response[i]['ZreadDate'];       
                  var Expenses = response[i]['Expenses'];  
                  addData4(i,ZreadDate,Expenses);
                }  
                $("#loading").remove();   
              }
            })
          }
        // function LoadDatatable2() {
        //   var table2 = $('#example4').DataTable({
        //     "responsive": true,
        //     "processing": true,
        //     "pageLength": 50,
        //     "bPaginate": false,
        //     "bLengthChange": false,
        //     "bFilter": false,
        //     "bInfo": false,
        //     "bAutoWidth": false
        //   }); 
        // }
        </script> -->
                 