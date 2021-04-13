<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

define('DB_Name', 'augustco_invoiceSoftware');
define('DB_Host', '127.0.0.1');


$testCon = new mysqli(DB_Host, $username, $password, DB_Name);
if ($testCon) {
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    header("Location: https://augustcollectives.com/main-page.php");
    //echo '<script type="text/javascript">location.href = 'main-page.php';</script>';
}
else {
    die(mysqli_connect_error());
    //echo '<script type="text/javascript">location.href = 'index.php';</script>';
}
?>