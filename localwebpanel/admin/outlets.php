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
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include_once('templates/nav.php');?>
<?php include_once('templates/sidenav.php');?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List of Outlets</h1>  
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List of Outlets</li>
            </ol>
          </div>
        </div>
      </div>
    </section>  
    <section class="content">
      <div class="row">
        <div class="col-md-3">
            <button class="btn btn-sm btn-warning btn-block mb-3 " data-toggle="modal" data-target="#modal-add-outlet" type="button">New Outlet</button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-sm btn-secondary btn-block mb-3 " data-toggle="modal" data-target="#modal-assign-manager" type="button">Assign Manager</button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-sm btn-secondary btn-block mb-3 " data-toggle="modal" data-target="#modal-transfer-outlet" type="button">Transfer Ownership</button>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Outlets</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12"> 
                  <table id="example1" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                      <tr>
                        <th>Store Name</th>
                        <th>Address</th>
                        <th>Location</th>    
                        <th>Franchisee</th>
                        <th>Status</th>    
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Store Name</th>
                        <th>Address</th>
                        <th>Location</th>    
                        <th>Franchisee</th>
                        <th>Status</th> 
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<?php include_once('templates/webfooter.php');?>
<?php include 'modals/addoutletmodal.php'; ?>
<?php include 'modals/assignmanager.php'; ?>
<?php include 'modals/transferownershipmodal.php'; ?>
<aside class="control-sidebar control-sidebar-dark">
</aside>
<script src="../plugins/jquery/jquery.min.js"></script>
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
$( document ).ready(function() {
  LoadAcc();
  LoadBrands();
  LoadMunicipalities();
  LoadDatatable();
  LoadStores();
  LoadManagers();
});

function LoadAcc() {
  $("#owners").append('<option>Fetching...</option>');
  $("#transfer_owner").append('<option>Fetching...</option>');
    $.ajax({
    url: 'dtserver/getaccounts.php',
    type: 'post',
    dataType: 'json',
    success:function(response){  
     var len = response.length;
     $("#owners").empty();
     $("#transfer_owner").empty();
     
     for( var i = 0; i<len; i++){
         var brandname  = response[i]['Name'];
         var brandvalue = response[i]['Value'];          
         $("#owners").append("<option value='"+brandvalue+"'>"+brandname+"</option>");   
         $("#transfer_owner").append("<option value='"+brandvalue+"'>"+brandname+"</option>");  
     }
    }
  })
}
function LoadManagers() {
  $("#owners1").append('<option>Fetching...</option>');
    $.ajax({
    url: 'dtserver/getmanageraccounts.php',
    type: 'post',
    dataType: 'json',
    success:function(response){  
     var len = response.length;
     $("#owners1").empty();
     for( var i = 0; i<len; i++){
         var brandname  = response[i]['Name'];
         var brandvalue = response[i]['Value'];          
         $("#owners1").append("<option value='"+brandvalue+"'>"+brandname+"</option>");   
     }
    }
  })
}
function LoadStores() {
  $("#stores").append('<option>Fetching...</option>');
  $("#store_to_transfer").append('<option>Fetching...</option>');
    $.ajax({
    url: 'dtserver/getselectstores.php',
    type: 'post',
    dataType: 'json',
    success:function(response){  
     var len = response.length;
     $("#stores").empty();
     $("#store_to_transfer").empty();
     for( var i = 0; i<len; i++){
         var brandname  = response[i]['StoreName'];
         var brandvalue = response[i]['StoreID'];          
         $("#stores").append("<option value='"+brandvalue+"'>"+brandname+"</option>");
         $("#store_to_transfer").append("<option value='"+brandvalue+"'>"+brandname+"</option>");
     }
    }
  })
}
function LoadBrands() {
  $("#brands").append('<option>Fetching...</option>');
    $.ajax({
    url: 'dtserver/getbrands.php',
    type: 'post',
    dataType: 'json',
    success:function(response){  
     var len = response.length;
     $("#brands").empty();
     for( var i = 0; i<len; i++){
         var brandname  = response[i]['Name'];
         var brandvalue = response[i]['Value'];          
         $("#brands").append("<option value='"+brandvalue+"'>"+brandname+"</option>");
     }
    }
  })
}
function LoadMunicipalities() {
  $("#province").append('<option>Fetching...</option>');
    $.ajax({
    url: 'dtserver/getmun.php',
    type: 'post',
    dataType: 'json',
    success:function(response){  
     var len = response.length;
     $("#province").empty();
     for( var i = 0; i<len; i++){
         var brandname  = response[i]['Name'];
         var brandvalue = response[i]['Value'];          
         $("#province").append("<option value='"+brandvalue+"'>"+brandname+"</option>");
     }
    }
  })
}
function LoadDatatable() {
  $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "processing": true,
      "serverSide": true,
      "pageLength": 10,
      "ajax": "dtserver/getListOfOutlets.php",
      columnDefs: [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                render: function (data, type, row) {
                    return row[4] + ', ' + row[5];
                },
                targets: 3,
            },
            { visible: false, targets: [4] },
        ],
  });

  // $.getJSON('dtserver/getListOfOutlets.php', function(response) {
  //         for( var i = 0; i<response.length; i++){
  //             $('#outlets').append('<tr>'
  //                                   // +'<td>'+response[i].id+'</td>'
  //                                   +'<td>'+response[i].name+'</td>'
  //                                   +'<td>'+response[i].address+'</td>'
  //                                   +'<td>'+response[i].location_name+'</td>'
  //                                   +'<td>'+response[i].franchisee+'</td>'
  //                                   +'<td>'+response[i].Status+'</td>'
  //                                   +'<td><a href="'+window.location.origin+'/dgpos.app/admin/?sales"><input type="button" class="btn btn-primary" value="View Sales" /></a></td></tr>')   
  //         } 
  //     })
}
function getUnderCategory(id){
  $("#under_category").empty();
  $.post("dtserver/get_add.php",
  {
     id:id
  },
  function(data,status) {
     if (status == "success") {
        try {
           eval(data);
        } catch (e) {
           if (e instanceof SyntaxError) {
              console.log(e.message);
           }
        }
     }
  });
}
</script>

</body>
</html>