<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <label>Select Store:</label>
      <select id="stores3" class="custom-select">
      <option value="All">All</option>
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
            <button type="button" id="4" onclick="ApxChart3(this.id);" class="btn btn-block btn-secondary btn-flat">Search</button>          
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

      var chartApex3 = new ApexCharts(document.querySelector("#ApexChart3"), optionsapex3);
      chartApex3.render();    
    </script>        
    <script type="text/javascript">

    function ApxChart3(btnid) {
      if (btnid == 4){
          $("#custom-tabs-four-tabContent").append("<div id='loading' class='overlay-wrapper'><div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i></div></div>");
      }
      var dateval = $("#datepicker-pick3").val();
      var storeid = $("#stores3").val();
      // var productid = $("#productids").val();
      var productid = $("#productids option:selected" ).text();

        $.getJSON('dtserver/getproductsales.php?btnid='+btnid+'&dateval='+dateval+'&storeid='+storeid+'&productid='+productid+'&productid='+productid, function(response) {

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
      "ajax": {url:'dtserver/getproductsales.php?btnid='+btnid+'&dateval='+date+'&storeid='+storeid+'&productid='+productid,dataSrc:""},
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

   
    </script>          
               
  </div>
</div>