<?php
//database config settings
define('DB_Name', 'dhruva_tables');
define('DB_User','root');
define('DB_Password','');
define('DB_Host', '127.0.0.1');


$con = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
if ($con->connect_error) {
	die("Connection failed");
}

?>