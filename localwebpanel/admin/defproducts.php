<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Innovention</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- This  -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" > 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Datatable -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
 <!-- Datatable -->
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
            <h1 class="m-0 text-dark">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
  <div class="row">
        <div class="col-md-3">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Actions</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div><!-- /.card-tools -->
            </div><!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-secondary btn-block mb-3 " data-toggle="modal" data-target="#modal-add-product" type="button">Add New Product</button>
            </div>
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example"class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date Modified</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date Modified</th>
                    <th>Action</th>
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
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Datatable -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Datatable -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../dist/js/demo.js"></script>

<script>

  function editproduct(id) {
    window.location.href = "?edtprd=" + id;
  }
  function GetFormulaID() {
    var formulaid = $('#selectformula').val();
    var appendedinput = $('#appendformulaid').val();
    if (appendedinput == '') {  
      document.getElementById('appendformulaid').value +=  formulaid;
    } else {
      document.getElementById('appendformulaid').value += ',' + formulaid;
    } 
  }
$( document ).ready(function() {
  LoadDatatable()
});
function deleteproduct(id) {
  var r = confirm("Are you sure do you want to delete this product ?");
  if (r == true) {
    $.ajax({  
      url:"actions/deleteproduct.php",  
      method:"POST",  
      data:{id:id},  
      success:function(data){ 
        var table = $('#example').DataTable();
        $('#example').empty();
        table.destroy();
        LoadDatatable();
        alert(data);
      }  
    });  
  } 
}
function LoadDatatable() {
  $("#example").DataTable({
    "responsive": true,
    "autoWidth": false,
    "processing": true,
    "serverSide": true,
    "order": [[6, "asc"]],
    "ajax": "dtserver/getproducts.php",
    "columnDefs": [{
          "render": function ( data, type, row ) {
          return data + ' ' + row[7];
      }, "targets": 0 
     },{ "width": "40%", "targets": 0 }]
  });
}
</script>

<?php include 'modals/addproductmodal.php'?>
  <script> 
    function disableSelect(id) {
      // var category = document.getElementById("SelCategory").value;
      // alert(category);
      // if (category == "Others") {
      //   $("#SelInVat").selectmenu("enable");
      // } else {
      //   $("#SelInVat").selectmenu("disable");
      // }

      $('SelCategory').on('change', function() {
  alert( this.value );
});
      // $("#nativeSelectMenu").selectmenu("disable");
      // $("#customSelectMenu").selectmenu("disable");
    }
    function getval(sel)
    {
      if (sel == "Others") {
        document.getElementById("SelInVat").disabled=true;
      } else {  
          document.getElementById("SelInVat").disabled=false;
      }

    }
</script> 
</body>
</html>
    
