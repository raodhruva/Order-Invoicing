<body>

<form action = "analyticsDisplay.php" method = "post">

<label><b>Search for Orders</b><br><br></label> 

<label for = "supplierName"> Search By Supplier: </label>
<select id="supplierName" name = "supplierNameDropdown">
  <option></option>
              <!-- inserting company names dynamically to dropdown list from supplier data table -->

              <?php
              require("config.php");

              $sql = mysqli_query($con, "SELECT supplierName FROM supplierData");
              while ($row = $sql->fetch_assoc()){
                echo "<option>" . $row['supplierName'] . "</option>";
              }
              ?>

            </select>

<label for = "customerName"> Search By Customer: </label>
<input type = "text" id = "customerName" name = "customerName" placeholder="Customer Name" />

<label for = "startDate"> Start Date: </label>
<input type = "date" id = "startDate" name = "startDate" />
<label for = "endDate"> End Date: </label>
<input type = "date" id = "endDate" name = "endDate" />

<input type = "submit" name = "action" value = "Submit-1"/>


<label><br><br><b>Search for Sale of ITEM </b><br><br></label>
<label for = "itemNo">Enter Item No</label>
<input type = "text" id = "itemNo" name = "itemNo"/>
<input type = "submit" name = "action" value = "Submit-2"/>

<label><br><br><br><b> TOTAL SALES:</b></label>
<!-- put php code for total sales here -->
<?php
require("config.php");

$totalSalesQuery = "SELECT SUM(grandTotal) AS totalSales FROM orderTable";

$result = $con ->query($totalSalesQuery); 
$row = $result->fetch_assoc(); 
$sum = $row['totalSales'];
echo $sum." USD";
?>


<input type = "hidden" id = "submitButtonPressed" name = "submitButtonPressed">


</form>



</body> 