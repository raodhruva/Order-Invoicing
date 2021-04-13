<script type="text/javascript">
	var sno;
	var deletedValuesArray = [];
	var subtotal = 0;
	deletedValuesArray.push("placeholderVal");

	function dataInit(){
		document.getElementById("added").style.display = "block";
		document.getElementById("adding").style.display = "none";

	}
	function toggleHidden() {
		var x = document.getElementById("added");
		var y = document.getElementById("adding");
		var vendorNameInput = document.getElementById("vendorNameInput");
		var vendorAddressInput1 = document.getElementById("vendorAddressInput1");
		var vendorAddressInput2 = document.getElementById("vendorAddressInput2");
		var vendorAddressInput3 = document.getElementById("vendorAddressInput3");

		if (x.style.display === "none") {
			x.style.display = "block";
			y.style.display = "none";
			vendorNameInput.value = "";
			vendorAddressInput1.value = "";
			vendorAddressInput2.value = "";
			vendorAddressInput3.value = "";
		} else {
			x.style.display = "none";
			y.style.display = "block";
		}
	}
	function Add() {
		sno++;

		var qty = document.getElementById("tqty").value;
		var conItemNo = document.getElementById("tconItemNo").value;
		var cusItemNo = document.getElementById("tcusItemNo").value;
		var desc = document.getElementById("tdesc").value;
		var col = document.getElementById("tcol").value;
		var size = document.getElementById("tsize").value;
		var packing = document.getElementById("tpacking").value;
		var price = document.getElementById("tprice").value;
		var total = document.getElementById("ttotal").value;
    //override the previous statement to give total as the product of price and quantity
    total = price*qty;

    var table=document.getElementById("tblCustomers");
    var table_len=(table.rows.length)-1;

    var tmpHTML = "";
    tmpHTML += "<tr id='row"+sno+"'>";
    //tmpHTML += "<td>"+sno+"</td>";
    tmpHTML += "<td><input type='number' id='tqty"+sno+"' name='tqty"+sno+"'  value='" +qty+"'></td>";
    tmpHTML += "<td><input type='text' id='tconItemNo"+sno+"' name='tconItemNo"+sno+"'  value='" +conItemNo+"'></td>";
    tmpHTML += "<td><input type='text' id='tcusItemNo"+sno+"' name='tcusItemNo"+sno+"'  value='" +cusItemNo+"'></td>";
    tmpHTML += "<td><input type='text' id='tdesc"+sno+"' name='tdesc"+sno+"'  value='" +desc+"'></td>";
    tmpHTML += "<td><input type='text' id='tcol"+sno+"' name='tcol"+sno+"'  value='" +col+"'></td>";
    tmpHTML += "<td><input type='text' id='tsize"+sno+"' name='tsize"+sno+"'  value='" +size+"'></td>";
    tmpHTML += "<td><input type='text' id='tpacking"+sno+"' name='tpacking"+sno+"'  value='" +packing+"'></td>";
    tmpHTML += "<td><input type='number' id='tprice"+sno+"' name='tprice"+sno+"'  value='" +price+"'></td>";
    tmpHTML += "<td><input type='number' id='ttotal"+sno+"' name='ttotal"+sno+"'  value='" +total+"'></td>";
    tmpHTML += "<td><input type='button' value='Delete' class='delete' onclick='Delete_row(this, "+sno+")'></td></tr>";

    var row = table.insertRow(table_len).outerHTML=tmpHTML;
    form.numberOfRows.value = sno;
    subtotal += total;
    CalculateTotal();
};

function Delete_row(element, serialNo) {
//element to delete the correct row and serialNo to keep track of which row it was
var rowNumber = element.parentNode.parentNode.rowIndex;

//subtracting from subtotal
var totalid = "ttotal" + rowNumber;
subtotal -= document.getElementById(totalid).value; 

document.getElementById("tblCustomers").deleteRow(rowNumber);
deletedValuesArray.push(serialNo);

CalculateTotal();

}

function CalculateTotal() {
    //multiply quantity by price to get total
    document.getElementById("grandTotal").value = subtotal;
}

function BeforeSubmission() {
	CalculateTotal();
	form.deletedValues.value = JSON.stringify(deletedValuesArray);

}

function returnSerialNumber(serialNumber, previousRowsTotal) {
	//also assign the right value for the number of rows in the form
	form.numberOfRows.value = serialNumber;
	sno = serialNumber;
	document.getElementById("grandTotal").value = previousRowsTotal;
	subtotal = previousRowsTotal;
}

</script>
<style>
	body {
		font-family: Arial;
		font-size: 17px;
		padding: 8px;
	}

	* {
		box-sizing: border-box;
	}

	.row {
		display: -ms-flexbox; /* IE10 */
		display: flex;
		-ms-flex-wrap: wrap; /* IE10 */
		flex-wrap: wrap;
		margin: 0 -16px;
	}

	.col-25 {
		-ms-flex: 25%; /* IE10 */
		flex: 25%;
	}

	.col-50 {
		-ms-flex: 50%; /* IE10 */
		flex: 50%;
	}

	.col-75 {
		-ms-flex: 75%; /* IE10 */
		flex: 75%;
	}

	.col-25,
	.col-50,
	.col-75 {
		padding: 0 16px;
	}

	.container {
		background-color: #f2f2f2;
		padding: 5px 20px 15px 20px;
		border: 1px solid lightgrey;
		border-radius: 3px;
	}

	input[type=text] {
		width: 100%;
		margin-bottom: 20px;
		padding: 12px;
		border: 1px solid #ccc;
		border-radius: 3px;
	}

	label {
		margin-bottom: 10px;
		display: block;
	}

	.icon-container {
		margin-bottom: 20px;
		padding: 7px 0;
		font-size: 24px;
	}

	.btn {
		background-color: #4CAF50;
		color: white;
		padding: 12px;
		margin: 10px 0;
		border: none;
	}

	.btn:hover {
		width: 100%;
		border-radius: 3px;
		cursor: pointer;
		font-size: 17px;
		background-color: #45a049;
	}

	a {
		color: #2196F3;
	}

	hr {
		border: 1px solid lightgrey;
	}

	span.price {
		float: right;
		color: grey;
	}
	table th,td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	h1 {
		font-style: italic;
	}

</style>

<?php

require("config.php");

echo '<body onload="dataInit()">
<form action = "insertion.php" method = "post" id= "form" name = "form" onsubmit="BeforeSubmission()">
<div class = "container">

<h2>ORDER</h2>
<div class="row">
<div class="col-50">
<b>Vendor:</b>
<p></p>
<div id="added">

<select id="vendorName" name = "vendorNameDropdown">
<!-- inserting company names dynamically to dropdown list from supplier data table -->';

$orderNo = $_GET['thisOrderId'];

$getValuesQuery = "SELECT * FROM orderTable WHERE orderNumber = '$orderNo'";

$result = $con->query($getValuesQuery) or die($con->error);
$row = mysqli_fetch_assoc($result);
$orderNumber = $row['orderNumber'];
$vendorName = $row['vendorName'];
$customerName = $row['customerName'];
$customerAddress1 = $row['customerAddress1'];
$customerCity = $row['customerCity'];
$customerCountry = $row['customerCountry'];
$deliveryDate = $row['deliveryDate'];
$mode = $row['mode'];
$remarks = $row['remarks'];
$deliveryNumber = $row['deliveryNumber'];
$grandTotal = $row['grandTotal'];



$supplierOptions = mysqli_query($con, "SELECT supplierName FROM supplierData");
while ($row = $supplierOptions->fetch_assoc()){
	//set value to selected
	$selected = ($row['supplierName'] == $vendorName ? "selected" : ""); 

	echo "<option ".$selected.">" . $row['supplierName'] . "</option>";
}


echo '  </select>
<button type="button" onclick="toggleHidden()">Add New</button>
</div>     

<div id="adding">
<div class="col-50">
<input type="text" id="vendorNameInput" placeholder="XYZ Company" name = "vendorNameInput" value = "">
</div>
<div class="col-50">
<input type="text" id="vendorAddressInput1" placeholder="Address line 1" name="vendorAddress1" value = "">
<input type="text" id="vendorAddressInput2" placeholder="City/Pincode" name="vendorAddress2" value = "">
<input type="text" id="vendorAddressInput3" placeholder="Country" name="vendorAddress3" value = "">
<button type="button" onclick="toggleHidden()">Select from list</button>
</div>
</div>

</div>

<div class="col-50">
<b>Customer:</b>
<p></p>
<input type="text" id="cadr1" name ="customerName" placeholder="ABC Company" value = "'.$customerName.'">
<input type="text" id="cadr2" name ="customerAddress1" placeholder="Address line 1" value = "'.$customerAddress1.'">
<input type="text" id="cadr3" name ="customerAddress2" placeholder="City/Pincode" value = "'.$customerCity.'">
<input type="text" id="cadr4" name ="customerAddress3" placeholder="Country" value = "'.$customerCountry.'">
</div>
</div>
<p></p>
<div class="row">
<div class="col-50">
<label for="ddate">Delivery Date</label>
<input type="date" id="ddate" name="deliveryDate" value = "'.$deliveryDate.'">
</div>
<div class="col-50">
<label for="customer">Mode:</label>
<input type="text" id="mode" name="mode" placeholder="Eg: Ship/Air" value = "'.$mode.'">
</div>
</div>

<div class="row">
<div class="col-50">
<label for="customer">Remarks:</label>
<input type="text" id="remarks" name="remarks" placeholder="Add additional Remarks here" value = "'.$remarks.'">
</div>
<div class="col-50">
<label for="deliverNo">Item No. Vendor:</label>
<input type="text" id="deliverNo" name="deliveryNumber" placeholder="LS-00000" value = "'.$deliveryNumber.'">
</div>
</div>  
<div class="row">
<div class="col-50">
<label for="orderNo">Order Number:</label>
<input type="text" id="orderNo" name="orderNo" placeholder="20678951" value = "'.$orderNo.'" readonly>
</div>
</div>';

echo ' <!-- Table starts ---> 
<table id="tblCustomers" name ="CustomerTable">
<thead>
<tr>
<th>Quantity</th>
<th>Item no.<br>Consginee</th>
<th>Item no.<br>Supplier</th>
<th>Description</th>
<th>Color</th>
<th>Size</th>
<th>Packing</th>
<th>Price<br>USD</th>
<th>Total<br>USD</th> 
<th></th>
</tr>
</thead> 
<tbody>
';

$displayOrderSpecs = "SELECT * FROM orderSpecs WHERE orderNumber = '$orderNo'";

if ($tableData = $con-> query($displayOrderSpecs)) {
	$sno = 0;
	while($row = $tableData-> fetch_assoc()) {
		$sno++;
		$orderNumber = $row["orderNumber"];
		$quantity = $row['quantity'];
		$conItemNo = $row["conItemNo"];
		$cusItemNo = $row["cusItemNo"];
		$description = $row["description"];
		$color = $row["color"];
		$size = $row["size"];
		$packing = $row["packing"];
		$price = $row["price"];
		$total = $row["total"];


		echo '<tr>
		<td><input type="number" id="tqty'.$sno.'" name = "tqty'.$sno.'" value = "'.$quantity.'"></td>
		<td><input type="text" id="tconItemNo'.$sno.'" name = "tconItemNo'.$sno.'" value = "'.$conItemNo.'"></td>
		<td><input type="text" id="tcusItemNo'.$sno.'" name = "tcusItemNo'.$sno.'" value = "'.$cusItemNo.'"></td>
		<td><input type="text" id="tdesc'.$sno.'" name = "tdesc'.$sno.'"  value ="'.$description.'"></td>
		<td><input type="text" id="tcol'.$sno.'" name = "tcol'.$sno.'" value = "'.$color.'"></td>
		<td><input type="text" id="tsize'.$sno.'" name = "tsize'.$sno.'" placeholder="50x70" value = "'.$size.'"></td>
		<td><input type="text" id="tpacking'.$sno.'" name = "tpacking'.$sno.'" placeholder="6_63" value = "'.$packing.'"></td>
		<td><input type="number" id="tprice'.$sno.'" name = "tprice'.$sno.'" value = "'.$price.'"></td>
		<td><input type="number" id="ttotal'.$sno.'" name = "ttotal'.$sno.'" value = "'.$total.'"></td>
		<td><input type="button" value="Delete" class="delete" onclick="Delete_row(this,'.$sno.')"></td>
		</tr> ';

	}

}
else {
	echo $con->error;
}

$tableData->free();

echo '<td><input type="number" id="tqty" ></td>
<td><input type="text" id="tconItemNo" ></td>
<td><input type="text" id="tcusItemNo" ></td>
<td><input type="text" id="tdesc" ></td>
<td><input type="text" id="tcol" ></td>
<td><input type="text" id="tsize" placeholder="50x70"></td>
<td><input type="text" id="tpacking" placeholder="6_63"></td>
<td><input type="number" id="tprice" ></td>
<td><input type="number" id="ttotal" ></td>
<td><input type="button" onclick="Add()" value="Add" /></td>
</tr>
</tbody>
</table>
<div>
<input type = "number" id = "grandTotal" name = "grandTotal" value= "" style="float:right"/>
<input type = "hidden" name = "numberOfRows" id = "numberOfRows" />
<input type = "hidden" name = "deletedValues" id = "deletedValues" />
</div>

<body>
</body>
<div style = "float:right">
<input type = "submit" value = "Submit">
</div>
</div>
</form>
</body> ';

//this has to be done at the end as numberOFRows hasnt been created yet
echo '<script type="text/javascript">',
'returnSerialNumber('.$sno.', '.$grandTotal.');',
'</script>';

?>