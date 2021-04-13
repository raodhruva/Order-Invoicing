<?php
session_start();
?>

<script>

	//   //Function for making rows clickable using an event listener (jQuery)
	//   $(document).ready(function () {
	//       $(document.body).on("click", "tr[data-href]", function () {
	//           window.location.href = this.dataset.href;
	//       });
	//   });

	function search() {
	  // Declare variables 
	  var input, filter, table, tableRow, td, i, txtValue;
	  input = document.getElementById("searchBox");
	  filter = input.value;
	  table = document.getElementById("tblOrders");
	  tableRow = table.getElementsByTagName("tr");

	  // Loop through all table rows, and hide those who don't match the search query
	  for (i = 0; i < tableRow.length; i++) {
	  	td = tableRow[i].getElementsByTagName("td")[1];
	  	if (td) {
	  		txtValue = td.textContent || td.innerText;
	  		if (txtValue.indexOf(filter) > -1) {
	  			tableRow[i].style.display = "";
	  		} else {
	  			tableRow[i].style.display = "none";
	  		}
	  	} 
	  }
	}

	function EditValues(orderNumber) {
		window.location.href = "edit-form.php?thisOrderId=" + orderNumber;
	}

	function PrintInvoice(orderNumber) {
		window.location.href = "print-invoice.php?thisOrderId=" + orderNumber;
	}

	function DeleteEntry(orderNumber) {
		alert("password is required to delete");
	}		


</script>

<style>
	body {
		font-family: Arial;
		font-size: 17px;
		padding: 8px;
	}

	tr[data-href]{
		cursor = pointer;
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
		width: 100%;
		border-radius: 3px;
		cursor: pointer;
		font-size: 17px;
	}

	.btn:hover {
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
<body>
	<div class="container">
		<label for="searchBox">Order:</label>
		<input type="text" id="searchBox" onkeyup="search()" placeholder="Search order number...">

		<!--use the hidden input variable to save the order number clicked -->
		<input id = "orderId" type = "hidden" name = "orderId"/>

		<button onclick="window.location.href = 'insertion-form.php';">Add</button>
		<button onclick="window.location.href = 'analytics.php';"> Run Analytics </button>
		<p> </p>

		<?php
		require("config.php");

		echo '<table id="tblOrders" name ="OrderTable" style="width: 100%">
		<tr>
		<th>Sno</th>
		<th>Order Number</th>
		<th>Customer Name</th>
		<th>Vendor Name</th>
		<th>Delivery Date</th>
		<th>Order Status</th>
		</tr>';

		$displayTableDataQuery = "SELECT orderNumber, customerName, vendorName, deliveryDate, orderComplete FROM orderTable";

		if ($tableData = $con-> query($displayTableDataQuery)) {
			$sno = 1;
			while($row = $tableData-> fetch_assoc()) {
				$orderNumber = $row["orderNumber"];
				$customerName = $row["customerName"];
				$vendorName = $row["vendorName"];
				$deliveryDate = $row["deliveryDate"];
				$orderComplete = ($row['orderComplete'] > '0' ? 'Completed':'Incomplete');
				$editButtonStatus = ($row['orderComplete'] > '0' ? 'disabled':'');

				echo '<tr align = "center">
				<td>'.$sno++.'</td>
				<td id = "orderNumber">'.$orderNumber.'</td> 
				<td>'.$customerName.'</td>
				<td>'.$vendorName.'</td> 
				<td>'.$deliveryDate.'</td>
				<td>'.$orderComplete.'</td>
				<td><input type = "button" id ="editButton'.$sno.'" value = "Edit" onclick = "EditValues('.$orderNumber.');" '.$editButtonStatus.'/> </td>
				<td><input type = "button" id = "printInvoice'.$sno.'" value="Print" onclick = "PrintInvoice('.$orderNumber.');" /> </td>
				<td><input type = "button" id = "DeleteEntry'.$sno.'" value="Delete" onclick = "DeleteEntry('.$orderNumber.');" /> </td>
				</tr>';
			}

		}
		else {
			echo $con->error;
		}

		$tableData->free();
		?>
	</div>
</body>
