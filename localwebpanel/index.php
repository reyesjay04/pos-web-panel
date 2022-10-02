<?php session_start();

  include_once 'resources/config.php';

    if ($_SERVER['REQUEST_URI'] == $_POSURI) {
      include('login.php');
    } elseif(isset($_GET['reg'])) {
      include("register.php");
    } else {
      include("resources/404.php");
    }
?>
