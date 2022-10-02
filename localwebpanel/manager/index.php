<?php session_start();

  $StoreIDS     = $_SESSION["manager_store_id"];
  $ManagerGuids = $_SESSION["manager_store_guid"];

  if ($ManagerGuids == "") {
    $ManagerGuids = "'N/A'";
  }
  if ($StoreIDS == "") {
    $StoreIDS = "'N/A'";
  }
  if(!isset($_SESSION["managerpanel"])) {
    header("Location:../");
  } else {
    if ($_SERVER['REQUEST_URI'] == "/manager/" || $_SERVER['REQUEST_URI'] == "/manager/?dashboard") {

        include('dashboard.php');

    } elseif(isset($_GET['outlets'])) {

        include("outlets.php");

    } elseif(isset($_GET['users'])) {

        include("users.php");
        
    }
    elseif(isset($_GET['settings'])) {
        include("generalsettings.php");
    }
    elseif(isset($_GET['defprod'])) {
        include("defproducts.php");
    }
    elseif(isset($_GET['defcat'])) {
        include("defcategory.php");
    }
    elseif(isset($_GET['defform'])) {
        include("defformula.php");
    }
    elseif(isset($_GET['definv'])) {
        include("definventory.php");
    }
    elseif(isset($_GET['pmanagement'])) {
        include("pmanagement.php");
    }
    elseif(isset($_GET['sales'])) {
      include("sales.php");
    }
    elseif(isset($_GET['transaction'])) {
      include("transaction.php");
    }
    elseif(isset($_GET['inventory'])) {
      include("inventory.php");
    }
    elseif(isset($_GET['store'])) {
      include("viewmore.php");
    }
    elseif(isset($_GET['viewinv'])) {
      include("viewinv.php");
    }
    elseif(isset($_GET['contact'])) {
      include("contact.php");
    }
    elseif(isset($_GET['about'])) {
      include("about.php");
    }
    elseif(isset($_GET['logs'])) {
      include("logs.php");

    } elseif(isset($_GET['syslogs'])) {
      include("storelogs.php");

    } elseif(isset($_GET['inbox'])) {
      include("message.php");

    } elseif(isset($_GET['profile'])) {
      include("profile.php");

    } elseif(isset($_GET['faqs'])) {
      include("faqs.php");

    } elseif(isset($_GET['help'])) {
      include("help.php");

    } else {
      include '../resources/404.php';

    }
  }
?>
<script type="text/javascript">
  function logout() {
    $.ajax({  
      url:"actions/logout.php",  
      success:function(data){  
       window.location = "../";
      }  
    });  
  }
  function contactus() {
    window.open('mailto:aiolosinnovativesolutions@gmail.com?subject=subject&body=body');
  }
  function profile() {
    window.location = "?profile";
  }
</script>