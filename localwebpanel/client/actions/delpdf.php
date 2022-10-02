<?php 

$filepath =  '../print/';
array_map('unlink', glob("$filepath*.csv") ?: []); // check folder is empty or not
?>