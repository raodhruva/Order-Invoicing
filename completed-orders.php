<?php
require("config.php");

$orderId = $_GET['thisOrderId'];

$updateCompletedOrder = "UPDATE orderTable SET orderComplete = 1 WHERE orderNumber = '$orderId'";

if ($con -> query($updateCompletedOrder)) {
	echo "Order was marked as complete";
}
else {
	echo $con->error;
}

?>