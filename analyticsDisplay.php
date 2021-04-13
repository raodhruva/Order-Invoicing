<?php

require("config.php");

if ($_POST['action'] == "Submit-1") {		

	$query1 = "SELECT * FROM orderTable WHERE id > 0 ";

	if (!empty($_POST['customerName'])) {
		$customerName = $_POST['customerName'];
		$query1.= "AND customerName = '$customerName' ";
	}
// supplier name field doesnt exist in DB yet
	if (!empty($_POST['supplierNameDropdown'])) {
		$supplierName = $_POST['supplierNameDropdown'];
		$query1.= "AND vendorName = '$supplierName' ";
	}

	if (!empty($_POST['startDate'])) {
		$startDate = $_POST['startDate'];
		$query1.= "AND deliveryDate >= '$startDate' ";
	}

	if (!empty($_POST['endDate'])) {
		$endDate = $_POST['endDate'];
		$query1.= "AND deliveryDate <= '$endDate' ";
	}

	if ($tableData = $con -> query($query1)) {
		$sno = 0;
		while($row = $tableData -> fetch_assoc()) {
			$sno++;
			$orderNumber = $row['orderNumber'];
			$customerName = $row['customerName'];
			$vendorName = $row['vendorName'];
			$deliveryDate = $row['deliveryDate'];

			echo '<table><tr>
			<td>'.$sno.'</td>
			<td>'.$orderNumber.'</td>
			<td>'.$customerName.' </td>
			<td>'.$vendorName.' </td>
			<td>'.$deliveryDate.' </td>
			</tr></table>';
		}
	}
}

else if ($_POST['action'] = "Submit-2") {
	$itemNo = $_POST['itemNo'];
	$query2 = "SELECT SUM(quantity) AS totalUnits FROM orderspecs WHERE conItemNo = '$itemNo' OR cusItemNo = '$itemNo'";
	$result = $con ->query($query2); 
	$row = $result->fetch_assoc(); 
	$totalUnits = $row['totalUnits'];
	echo $totalUnits." Units";
}


?>