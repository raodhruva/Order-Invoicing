<?php
require("config.php");

$flag = 1;
$orderId = $_GET['thisOrderId'];
$partialVals = json_decode($GET['partialVals']);
$IDs = json_decode($GET['IDs']);

for ($i = 0; $i < count($IDs); $i++) {
$currentVal = $partialVals[$i];
$currentID = $IDs[$i];
$updateQuantitySupplied = "UPDATE orderspecs SET quantitySupplied = '$currentVal' WHERE id = '$currentID'";
if (!$con -> query($updateQuantitySupplied)) {
	$flag = 0;
}
}
 
$updateCompletedOrder = "UPDATE orderTable SET orderComplete = 1 WHERE orderNumber = '$orderId'";

if (!$con -> query($updateCompletedOrder)) {
	$flag = 0;
}


if ($flag) {
	echo 'everything worked fine!';
}
else {
	echo 'something went wrong';
}

?>