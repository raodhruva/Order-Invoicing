<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<script type="text/javascript">

  var flag = 0;

  function printpage() {
      // make all the page buttons invisible

        var printButton = document.getElementById("printpagebutton"); 
        var markCompleteButton = document.getElementById("markCompleteButton");
        var partialOrderButton = document.getElementById("partialOrderButton");
        var newTotalButton = document.getElementById("newTotalButton");
        var markCompleteText = document.getElementById("markCompleteText");
        printButton.style.visibility = 'hidden';
        markCompleteButton.style.visibility = "hidden";
        partialOrderButton.style.visibility = "hidden";
        newTotalButton.style.visibility = "hidden";
        markCompleteText.style.visibility = "hidden";
        //Print the page content
        window.print() 
        printButton.style.visibility = 'visible';
        markCompleteButton.style.visibility = "visible";
        partialOrderButton.style.visibility = "visible";
        newTotalButton.style.visibility = "visible";
        markCompleteText.style.visibility = "visible";
      }

      function calculateNewTotal(rows) {
        flag = 1;
        var j;
        var total= 0;
        for (j = 1; j <= rows; j++) {
          //set total = product
          var price = document.getElementById("price" + j); 
          var parQty = document.getElementById("partialQuantitySupplied" +j);
          document.getElementById("total" + j).innerHTML = price.innerHTML * parQty.value;
          //set td = input values and hide the input
          document.getElementById("partialQuantityFinal" + j).innerHTML = parQty.value;
          parQty.style.visibility = "hidden";
          //add to the total
          total += price.innerHTML * parQty.value;
        }
        document.getElementById("grandtotal").innerHTML = "GRAND TOTAL :" + total;
        document.getElementById("newTotalButton").style.visibility = "hidden";

      }

      function markComplete(orderNumber) {
        // make a call to completed-orders to change the db value from 0 to 1.
        $.ajax({
          url : 'completed-orders.php',
          dataType : 'text',
          data : {thisOrderId : orderNumber},
          success : function(data) {
            $("#markCompleteText").val(data);
          }
        });

        document.getElementById("markCompleteButton").style.visibility = "hidden";
        
      }

      function createPartialOrder(orderNumber) {
        if (flag == 1) {
        var i;
        var table = document.getElementById("tblCustomers");
        var rows = table.rows.length - 1;

        var differenceArray = [];

        //adding values to difference array
        for (i = 1; i <= rows; i++) {
          var ordered = document.getElementById("quantity" + i).innerHTML;
          var supplied = document.getElementById("partialQuantityFinal" + i).innerHTML;
          differenceArray.push(ordered - supplied);
        }
                
        // stringify and send difference array and orderId to partial order form
        var JSONstr = JSON.stringify(differenceArray);
        window.location.href = "partial-order.php?thisOrderId=" + orderNumber + "&differenceValues=" + JSONstr;

        }
        else {
          alert("Calculate New Total must be pressed first");
        }
        
      }

    </script>


<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>


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

    <body>
      <?php
      require("config.php");

      $orderNo = $_GET['thisOrderId'];

      $getValuesQuery = "SELECT * FROM orderTable WHERE orderNumber = '$orderNo'";

      $result = $con->query($getValuesQuery) or die($con->error);
      $row = mysqli_fetch_assoc($result);
      $orderNumber = $row['orderNumber'];
      $vendorName = $row['vendorName'];
      $vendorAddress1 = $row['vendorAddress1'];
      $vendorCity = $row['vendorCity'];
      $vendorCountry = $row['vendorCountry'];
      $customerName = $row['customerName'];
      $customerAddress1 = $row['customerAddress1'];
      $customerCity = $row['customerCity'];
      $customerCountry = $row['customerCountry'];
      $deliveryDate = $row['deliveryDate'];
      $mode = $row['mode'];
      $remarks = $row['remarks'];
      $deliveryNumber = $row['deliveryNumber'];
      $grandTotal = $row['grandTotal'];
      $orderComplete = $row['orderComplete'];

      echo '<div class = "container">
      <h2>Invoice</h2>

      <p> </p>

      <div class="row">
      <div class="col-50">
      <b>Vendor: '.$vendorName.'</b>
      <p> '.$vendorAddress1.' <br> '.$vendorCity.' <br>'.$vendorCountry.' <br></p>

      </div>

      <div class="col-50">
      <b>Customer: '.$customerName.'</b>
      <p> '.$customerAddress1.' <br> '.$customerCity.' <br>'.$customerCountry.' <br></p>
      </div>
      </div>

      <div class="row">
      <div class="col-50">
      <label> Delivery Date: '.$deliveryDate.'</label>
      </div>
      <div class="col-50">
      <label>Mode: '.$mode.'</label>
      </div>
      </div>

      <div class="row">
      <div class="col-50">
      <label>Order Number:'.$orderNumber.'</label>
      </div>
      <div class="col-50">
      <label>Delivery Number:'.$deliveryNumber.'</label>
      </div>
      </div> ';



      echo '     <!-- Table starts ---> 
      <table id="tblCustomers" name ="CustomerTable" width=100%>
      <thead>
      <tr>
      <th>Quantity<br>Ordered</th>
      <th>Quantity<br>Supplied</th>
      <th>Item no.<br>Consginee</th>
      <th>Item no.<br>Customer</th>
      <th>Description</th>
      <th>Color</th>
      <th>Size</th>
      <th>Packing</th>
      <th>Price/Unit<br>USD</th>
      <th>Total<br>USD</th> 
      </tr>
      </thead>';

      $displayOrderSpecs = "SELECT * FROM orderSpecs WHERE orderNumber = '$orderNo' ORDER BY id";

      if ($tableData = $con-> query($displayOrderSpecs)) {
        $sno = 0;
        while($row = $tableData-> fetch_assoc()) {
          $sno++;
          $quantity = $row['quantity'];
          $conItemNo = $row["conItemNo"];
          $cusItemNo = $row["cusItemNo"];
          $description = $row["description"];
          $color = $row["color"];
          $size = $row["size"];
          $packing = $row["packing"];
          $price = $row["price"];
          $total = $row["total"];
          echo '<tr align = "center">
          <td id = "quantity'.$sno.'">'.$quantity.'</td>
          <td id = "partialQuantityFinal'.$sno.'"><input type = "number" value = "'.$quantity.'" id = "partialQuantitySupplied'.$sno.'"></td> 
          <td>'.$conItemNo.'</td> 
          <td>'.$cusItemNo.'</td>
          <td>'.$description.'</td>
          <td>'.$color.'</td>
          <td>'.$size.'</td>
          <td>'.$packing.'</td>
          <td id = "price'.$sno.'">'.$price.'</td>
          <td id = "total'.$sno.'">'.$total.'</td>
          </tr>';
        }

      }
      else {
        echo $con->error;
      }

      $tableData->free();


      echo '</table>
      <p align = "right" id = "grandtotal"> GRAND TOTAL : '.$grandTotal.' </p>
      <body>';
      echo '<input type = "button" id = "newTotalButton" onclick="calculateNewTotal('.$sno.')" value = "calculate new total">';
      

      echo '<div style = "float:right">';
      if ($orderComplete == 0) {
        echo '<input type = "button" id = "markCompleteButton" onclick = "markComplete('.$orderNumber.')" value = "Mark as Complete"/>';        
      }

      echo  '<input type = "button" id = "partialOrderButton" onclick = "createPartialOrder('.$orderNumber.')"  value = "Create Partial Order"/>
      <input id="printpagebutton" type="button" value="Print" onclick="printpage()"/>
      </div>
      </div>
      </body>';
      
      echo '<input type = "text" id = "markCompleteText" value = ""/>';
      ?>