<?php 

$filepath = getcwd() . '/';
array_map('unlink', glob( "$filepath*.csv") ?: []); // check folder is empty or not
?>