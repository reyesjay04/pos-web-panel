<?php session_start();
  if(!isset($_SESSION["webpanel"])) {
    header("Location:../../");  
  } else {

    if (isset($_GET['category'])) {

        include('getcategory.php');

    } elseif (isset($_GET['getlist'])) { 

        include('getlist.php');

    } elseif (isset($_GET['getmessages'])) { 
        
        include('getmessages.php');

    } elseif (isset($_GET['getproductsales'])) { 
        
        include('getproductsales.php');
        
    } elseif (isset($_GET['getstoreids'])) { 
        
        include('getstoreids.php');
        
    } elseif (isset($_GET['gettopselling'])) { 
        
        include('gettopselling.php');
        
    } elseif (isset($_GET['getproductids'])) { 
        
        include('getproductids.php');
        
    }  elseif (isset($_GET['getsales'])) { 
        
        include('getsales.php');
        
    }  elseif (isset($_GET['getstores'])) { 
        $storeID = $_GET['getstores'];
        echo "<script>alert(".$storeID.");</script>";
        // include('getstores.php?store='.$_GET['getstores']);
 
    } else {

      include '../resources/404.php';

    }

    
  }
?>
