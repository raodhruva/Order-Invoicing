<?php 
require("config.php");

$orderNumber = $_POST['orderNo'];

//this is mainly useful for the delete function and prevent duplication
$deleteDuplicateOrder1 = "DELETE FROM orderTable WHERE orderNumber = '$orderNumber'";

if ($con-> query($deleteDuplicateOrder1) != TRUE) {
	die($con->error) ;
}

$deleteDuplicateOrder2 = "DELETE FROM orderspecs WHERE orderNumber = '$orderNumber'";

if ($con-> query($deleteDuplicateOrder2) != TRUE) {
	die($con->error);
}


//getting static customer data from the form


if(!empty($_POST['vendorNameInput'])) {
	$vendorName = $_POST['vendorNameInput'];
	$vendorAddress1 = $_POST['vendorAddress1'];
	$vendorCity = $_POST['vendorAddress2'];
	$vendorCountry = $_POST['vendorAddress3'];

	$addNewSupplier = "INSERT into supplierData(supplierName, supplierAddress1, supplierCity, supplierCountry) VALUES ('$vendorName', '$vendorAddress1', '$vendorCity', '$vendorCountry')";
		
	echo ($con->query($addNewSupplier) ? 'new supplier value successfully added <br>' : $con->error);
}
else {
	$vendorName = $_POST['vendorNameDropdown'];

	//get the vendor details from the supplier table
	$getSupplierDetailsQuery = "SELECT * FROM supplierData WHERE supplierName = '$vendorName'";
	if($tableData = $con-> query($getSupplierDetailsQuery)) {
		$row = $tableData-> fetch_assoc(); 
		$vendorAddress1 = $row['supplierAddress1'];
		$vendorCity = $row['supplierCity'];
		$vendorCountry = $row['supplierCountry'];
		

	}
	else {
		echo $con->error;
	}	

}

$customerName = $_POST['customerName'];
$customerAddress1 = $_POST['customerAddress1'];
$customerCity = $_POST['customerAddress2'];
$customerCountry = $_POST['customerAddress3'];

$deliveryDate = $_POST['deliveryDate'];
$mode = $_POST['mode'];
$remarks = $_POST['remarks'];

//delivery number change later
$deliveryNumber = $_POST['deliveryNumber'];

$grandTotal = $_POST['grandTotal'];

$orderCompleteDefault = 0;


$addIntoOrderGenerics = "INSERT INTO orderTable(orderNumber, vendorName, vendorAddress1, vendorCity, vendorCountry, customerName, customerAddress1, customerCity, customerCountry, deliveryDate, mode, remarks, deliveryNumber, grandTotal, orderComplete) VALUES ('$orderNumber', '$vendorName', '$vendorAddress1', '$vendorCity', '$vendorCountry', '$customerName', '$customerAddress1', '$customerCity', '$customerCountry', '$deliveryDate', '$mode', '$remarks', '$deliveryNumber', '$grandTotal', $orderCompleteDefault)";

echo ($con->query($addIntoOrderGenerics) ? "Order generic values were successfully added <br>" : $con->error);


$deletedValues = json_decode($_POST['deletedValues']);
//getting the number of rows in the form
$numberOfRows = $_POST['numberOfRows'];

//getting row data from the form
for ($i = 1; $i <= $numberOfRows; $i++) {
	if (in_array($i, $deletedValues) == FALSE) {
		$quantity = $_POST['tqty'.$i];
		$conItemNo = $_POST['tconItemNo'.$i];
		$cusItemNo = $_POST['tcusItemNo'.$i];
		$description = $_POST['tdesc'.$i];
		$col = $_POST['tcol'.$i];
		$size = $_POST['tsize'.$i];
		$packing = $_POST['tpacking'.$i];
		$price = $_POST['tprice'.$i];
		$total = $_POST['ttotal'.$i];
	//write this set of values to the DB

	//add order number to each one

		$addIntoOrderSpecifics = "INSERT INTO orderspecs(orderNumber, quantity, conItemNo, cusItemNo, description, color, size, packing, price, total) VALUES ('$orderNumber', '$quantity', '$conItemNo', '$cusItemNo', '$description', '$col', '$size', '$packing', '$price', '$total')";
		if($con ->query($addIntoOrderSpecifics) == TRUE) {
			echo "Order specific values for row were successfully added <br>";
		}
		else {
			echo $con->error;
		}
	}
}

$con-> close();

//phpinfo(); this is to get that purple page
?>

<button onclick="window.location.href = 'main_page.php';">GOTO MAIN PAGE</button>