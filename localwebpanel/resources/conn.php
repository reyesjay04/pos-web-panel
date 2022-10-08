<?php 
ob_start();
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");
defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", __DIR__ . DS . "uploads");
defined("UPLOAD_DIRECTORY_PROFILE") ? null : define("UPLOAD_DIRECTORY_PROFILE", __DIR__ . DS . "uploads\profile");
define('DB_NAME', 'posrev');
define('DB_USER', 'posrev');
define('DB_PASSWORD', 'posrev');
define('DB_HOST', 'localhost'); 
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}          

function ConnectionArray() {
	return $dbDetails = array('host' => DB_HOST, 'user' => DB_USER, 'pass' => DB_PASSWORD, 'db' => DB_NAME);
}                                                                            
?>