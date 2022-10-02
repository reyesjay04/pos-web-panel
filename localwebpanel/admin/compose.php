<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Innovention</title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
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
            <h1>Mailbox</h1>  
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mailbox</li>
            </ol>
          </div>
        </div>
      </div>
    </section>  
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <a type="button" class="btn btn-warning btn-block mb-3" href="?inbox">Back to inbox</a>
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
        <div class="col-md-8">
          <div class="card card-outline card-warning">
            <div class="card-header">
              <h3 class="card-title">
                Compose New Message
              </h3>
            </div>
            <div class="card-body pad">
              <div class="form-group">
                <select class="select2" multiple="multiple" id="emaillist" data-placeholder="To:" style="width: 100%;">
                </select>
              </div>
              <div class="form-group">
                <input class="form-control" id="message-subject" placeholder="Subject:">
              </div>
              <div class="mb-3">
                <textarea id="message-content" class="textarea" placeholder="Place some text here" style="width: 100%; height: 417px; resize: none; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
              <div class="mb-3">
                <button class="btn btn-block btn-warning" onclick="sendmsg();">Send</button>
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
<script src="../plugins/select2/js/select2.full.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
<script>
//moment([2007, 0, 29]).fromNow();
$(document).ready(function() {
  $('.select2').select2();
  getemailadds();
  getlist();
});

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
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
         $("#list").append("<div id="+EmailAdd+"><strong><iclass='fas fa-user mr-1'></i>"+To+"</strong><span class='text-muted float-right'>"+ReadIcon+DateCreated+"</span><p class='text-muted'>"+Content+"</p></div><hr>");                                                           
      }
    }
  })
}

function getemailadds() {
  $("#emaillist").empty();
  $("#emaillist").append("<option>Fetching...</option>"); 
  $.ajax({
    url: 'actions/finduser.php',
    type: 'post',
    dataType: 'json',
    success:function(response){  
     var len = response.length;
     $("#emaillist").empty();
     for( var i = 0; i<len; i++){
         var Guid = response[i]['Guid'];
         var Email = response[i]['Email'];          
         $("#emaillist").append("<option value='"+Email+"'>"+Email+"</option>");
     }
    }
  })
}

function cleartext() {
  $("#emaillist").val('');
  $("#message-subject").val('');
  $("#message-content").val('');
  $('.select2').val(null).trigger('change');
}
function sendmsg() {

  var from = "<?php echo $_SESSION['admin_user_name']?>";
  var emails = $("#emaillist").val();
  var subject = $("#message-subject").val();
  var content = $("#message-content").val();

  if (emails === undefined || emails.length == 0) {
    alert('Email address is required');
  } else {
    if (subject == '') {
      alert('Subject is required');
    } else {
      if (content == '') {
        alert('Content is required');
      } else {
        if (confirm('Are you sure you want to send this message(s)?')) {   
          alert('Sending message please wait.');
          $.ajax({
            type: 'post',
            url:  'actions/sendmessage.php',
            type: 'post',
            data:{from:from,'emails': emails ,subject:subject,content:content},
            success:function(data){  
              Toast.fire({
                icon: 'success',
                title: ' ' + data
              })
              cleartext();
              getlist();
            }
          })
        }         
      }
    }
  }


}

</script>
</body>
</html>
    
