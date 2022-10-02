<?php session_start();

  if(!isset($_SESSION["webpanel"])) {

    header("Location:../");
    
  } else {

      include '../resources/config.php';

    if ($_SERVER['REQUEST_URI'] == $_POSURI."admin/?dashboard" || $_SERVER['REQUEST_URI'] == $_POSURI."admin/") {

        include('dashboard.php');

    } elseif(isset($_GET['sales'])) {

        include("sales.php");

    } elseif(isset($_GET['outlets'])) {

        include("outlets.php");

    } elseif(isset($_GET['gtoid'])) {

        include("view_outlets.php");

    } elseif(isset($_GET['viewoutletsales'])) {

        include("viewoutletsales.php");

    } elseif(isset($_GET['users'])) {

        include("users.php");

    } elseif(isset($_GET['settings'])) {

        include("generalsettings.php");

    } elseif(isset($_GET['defprod'])) {

        include("defproducts.php");

    } elseif(isset($_GET['edtprd'])) {

        include("editproductpage.php");

    } elseif(isset($_GET['defcat'])) {

        include("defcategory.php");

    } elseif(isset($_GET['defform'])) {

        include("defformula.php");

    } elseif(isset($_GET['edtfrm'])) {

        include("editformulapage.php");
        
    } elseif(isset($_GET['definv'])) {

        include("definventory.php");

    } elseif(isset($_GET['pmanagement'])) {

        include("pmanagement.php");

    } elseif(isset($_GET['inbox'])) {

      include("message.php");

    } elseif(isset($_GET['compose'])) {

      include("compose.php");

    } elseif(isset($_GET['profile'])) {

      include("profile.php");

    }elseif(isset($_GET['faqs'])) {
        include("faqs.php");
  
      }  elseif(isset($_GET['help'])) {
        include("help.php");
  
      }elseif(isset($_GET['contact'])) {
        include("contact.php");
      }
      elseif(isset($_GET['about'])) {
        include("about.php");
      }else {

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
function profile() {
    window.location = "?profile";
}
</script>