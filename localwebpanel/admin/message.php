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
            <h1>Inbox</h1>  
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Inbox</li>
            </ol>
          </div>
        </div>
      </div>
    </section>  
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <a type="button" class="btn btn-warning btn-block mb-3" href="?compose">Compose</a>
          <div class="card card-outline card-warning">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list mr-1"></i>Inbox</h3>
              </div>
              <div class="card-body">
                <div class="direct-chat-messages" style="height: 548px;" id="list">
                </div>
              </div>
          </div>    
        </div>
<!--         <div class="col-md-4">
          
            <div class="card card-outline card-warning">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list mr-1"></i>Inbox</h3>
              </div>
              <div class="direct-chat-messages" style="height: 588px;">
                <table id="inboxtable" class="table table-striped projects dt-responsive nowrap" width="100%" cellspacing="0">
              <thead style="display: none;">
                <tr>
                  <th>Name</th>
                </tr>
              </thead>
                  <tbody id="list">
                  </tbody>
                </table>
              </div>
          </div>     
        </div> -->
        <div class="col-md-8">
          <div class="card card-outline card-warning">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-envelope mr-1"></i>Message</h3>
            </div>
            <div class="direct-chat-messages" style="height: 642px;">
              <div class="card-footer card-comments" id="table-message-content">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<?php include_once('templates/webfooter.php');?>
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
<script>
  //moment([2007, 0, 29]).fromNow();
$(document).ready(function() {
  getlist();
  // getmessages();
});

function getlist() {
  $("#list").empty();
  $.ajax({
    url: 'dtserver/?getlist',
    type: 'post',
    dataType: 'json',
    success:function(response){  
      var len = response.length;
      $("#list").empty();
      for( var i = 0; i<len; i++){
         var DateCreated = response[i]['DateCreated'];    
         var Content = response[i]['Content'];        
         var To = response[i]['To'];
         var EmailAdd = response[i]['EmailAdd'];
         var Read = response[i]['Read'];
         var ReadIcon = '';
         if (Read == 'Unsynced') {
          ReadIcon = "<i id=U"+To+" class='fas fa-times-circle mr-1'></i>";
         } else {
          ReadIcon = "<i id=C"+To+" class='fas fa-check-circle mr-1'></i>";
         }
         $("#list").append("<div id="+EmailAdd+" onclick='loadmessage(this.id)'><strong><iclass='fas fa-user mr-1'></i>"+To+"</strong><span class='text-muted float-right'>"+ReadIcon+DateCreated+"</span><p class='text-muted'>"+Content+"</p></div><hr>");                                                           
      }
    }
  })
}
function loadmessage(id) {
  getmessages(id);
}
function getmessages(id) {
  $("#table-message-content").empty();
  $.ajax({
    url: 'dtserver/getmessages.php',
    type: 'post',
    data: {id:id},
    dataType: 'json',
    success:function(response){  
      $("#table-message-content").empty(); 
      var len = response.length;
      for( var i = 0; i<len; i++){
        var FullName = response[i]['FullName'];
        var DateCreated = response[i]['DateCreated'];    
        var Content = response[i]['Content'];       
        $("#table-message-content").append("<div class='card-comment'><div class='comment-text' style='margin-left: 0px;'><span class='username'>"+FullName+"<span class='text-muted float-right'>"+DateCreated+"</span></span>"+Content+"</div></div>");
      }                                                              
    }
  })
}

</script>
</body>
</html>