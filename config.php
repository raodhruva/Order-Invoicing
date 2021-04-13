<?php
session_start();
//database config settings

$user = $_SESSION["username"];
$pass = $_SESSION["password"];
define('DB_Name', 'augustco_invoiceSoftware');
//define('DB_User','augustco_user1');
//define('DB_Password','AugustCollectives123');
define('DB_Host', '127.0.0.1');


$con = new mysqli(DB_Host, $user, $pass, DB_Name);
if ($con->connect_error) {
    header("Location: https://augustcollectives.com/");
	
}
//header("Location: main-page.php");
?>
