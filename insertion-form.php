  <script type="text/javascript">
    var sno=0;
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
      //gives the serial number of the table row
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
      //tmpHTML += "<td><input type = 'hidden' name = 'tsno"+sno+"'></td>";
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

function CalculateTotal(total) {
      //multiply quantity by price to get total
      document.getElementById("grandTotal").value = subtotal;

    }

    function BeforeSubmission() {
      CalculateTotal();
      form.deletedValues.value = JSON.stringify(deletedValuesArray);
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

    table tfoot td {
      background: 0 0;
      border: none;
      border-bottom: 1px solid black;
      white-space: nowrap;
      text-align: right;
      padding: 10px 20px;
    }

    table tfoot tr:first-child td {
      border-top: none
    }
    table tfoot tr td:first-child {
      border: none
    }
    table tfoot tr:last-child td {
      border:none
    }

    .wrap {
      text-align: center;
    }

  </style>

  <body onload="dataInit()">
    <form action = "insertion.php" method = "post" id= "form" name = "form" onsubmit="BeforeSubmission()">
      <div class = "container">

        <h2>ORDER</h2>
        <div class="row">
          <div class="col-50">
            <b>Vendor:</b>
            <p></p>
            <div id="added">

              <select id="vendorName" name = "vendorNameDropdown">
                <!-- inserting company names dynamically to dropdown list from supplier data table -->

                <?php
                require("config.php");

                $sql = mysqli_query($con, "SELECT supplierName FROM supplierData");
                while ($row = $sql->fetch_assoc()){
                  echo "<option>" . $row['supplierName'] . "</option>";
                }
                ?>

              </select>
              <button type="button" onclick="toggleHidden()">Add New</button>
            </div>     

            <div id="adding">
              <div class="col-50">
                <input type="text" id="vendorNameInput" placeholder="XYZ Company" name = "vendorNameInput">
              </div>
              <div class="col-50">
                <input type="text" id="vendorAddressInput1" placeholder="Address line 1" name="vendorAddress1">
                <input type="text" id="vendorAddressInput2" placeholder="City/Pincode" name="vendorAddress2">
                <input type="text" id="vendorAddressInput3" placeholder="Country" name="vendorAddress3">
                <button type="button" onclick="toggleHidden()">Select from list</button>
              </div>
            </div>

          </div>

          <div class="col-50">
            <b>Customer:</b>
            <p></p>
            <input type="text" id="cadr1" name ="customerName" placeholder="ABC Company">
            <input type="text" id="cadr2" name ="customerAddress1" placeholder="Address line 1">
            <input type="text" id="cadr3" name ="customerAddress2" placeholder="City/Pincode">
            <input type="text" id="cadr4" name ="customerAddress3" placeholder="Country">
          </div>
        </div>
        <p></p>
        <div class="row">
          <div class="col-50">
            <label for="ddate">Delivery Date</label>
            <input type="date" id="ddate" name="deliveryDate" value="2019-06-01">
          </div>
          <div class="col-50">
            <label for="customer">Mode:</label>
            <input type="text" id="mode" name="mode" placeholder="Eg: Ship/Air">
          </div>
        </div>

        <div class="row">
          <div class="col-50">
            <label for="customer">Remarks:</label>
            <input type="text" id="remarks" name="remarks" placeholder="Add additional Remarks here">
          </div>
          <div class="col-50">
            <label for="deliverNo">Item No. Vendor:</label>
            <input type="text" id="deliverNo" name="deliveryNumber" placeholder="LS-00000">
          </div>
        </div>  
        <div class="row">
          <div class="col-50">
            <label for="orderNo">Order Number:</label>
            <input type="text" id="orderNo" name="orderNo" placeholder="20678951" maxlength="10" required>
          </div>
        </div>

        <!-- Table starts ---> 
        <table id="tblCustomers" name ="CustomerTable">
          <thead>
            <tr>
              <!--<th>S.N.</th> -->
              <th>Quantity</th>
              <th>Item no.<br>Consginee</th>
              <th>Item no.<br>Supplier</th>
              <th>Description</th>
              <th>Color</th>
              <th>Size</th>
              <th>Packing</th>
              <th>Unit Price<br>(USD)</th>
              <th>Total<br>(USD)</th> 
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <!--<td></td> -->
              <td><input type="number" id="tqty" ></td>
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
          <tfoot>

          </tfoot>
        </table>

        <div class = "row" style="float:right">
          <input type = "number" id = "grandTotal" name = "grandTotal" value = "0" style="float:right"/>
          <input type = "hidden" name = "numberOfRows" id = "numberOfRows" />
          <input type = "hidden" name = "deletedValues" id = "deletedValues" />
          <input type = "submit" value = "Submit" style="float:right">
        </div>

      </div>
    </form>
  </body>