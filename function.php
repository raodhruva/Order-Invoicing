<?php
              require("config.php");
              $addconn = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
              
              if ($addconn->connect_error) {
              die("Connection failed");
              }
              
              $addcommand = "INSERT INTO orderspecs(Sno, desc1) VALUES (sno, tdesc)";
              if ($addconn->query($addcommand) == TRUE) {
                echo 'works';
              } 
              else {
                echo $addconn->error;
              }
            ?>



              //php code here to remove from the table
              <?php
              require("config.php");
              $deleteconn = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);

              $rowIndex = row.rowIndex;
              
              if ($deleteconn->connect_error) {
                  die("Connection failed");
              }

              $deletecommand = "DELETE FROM orderspecs WHERE ID = '$rowIndex'"

              ?>







              var tBody = document.getElementById("tblCustomers").getElementsByTagName("TBODY")[0];
 
            //Add Row.
            row = tBody.insertRow(-1);
            
            var cell = row.insertCell(-1);
            cell.innerHTML = sno;
            sno++;

            cell = row.insertCell(-1);
            cell.innerHTML = qty;
 
            cell = row.insertCell(-1);
            cell.innerHTML = conItemNo;

            cell = row.insertCell(-1);
            cell.innerHTML = cusItemNo;

            cell = row.insertCell(-1);
            cell.innerHTML = desc;

            cell = row.insertCell(-1);
            cell.innerHTML = col;

            cell = row.insertCell(-1);
            cell.innerHTML = size;

            cell = row.insertCell(-1);
            cell.innerHTML = packing;

            cell = row.insertCell(-1);
            cell.innerHTML = price;

            cell = row.insertCell(-1);
            cell.innerHTML = total;
 
            //Add Button cell.
            cell = row.insertCell(-1);
            var btnRemove = document.createElement("INPUT");
            btnRemove.type = "button";
            btnRemove.value = "Remove";
            btnRemove.setAttribute("onclick", "Remove(this);");
            cell.appendChild(btnRemove);




             /*function Edit(no) {
    var tqty = document.getElementById("tqty"+no);
    var tconItemNo = document.getElementById("tconItemNo"+no);
    var tcusItemNo = document.getElementById("tcusItemNo"+no);
    var tdesc = document.getElementById("tdesc"+no);
    var tcol = document.getElementById("tcol"+no);
    var tsize = document.getElementById("tsize"+no);
    var tpacking = document.getElementById("tpacking"+no);
    var tprice = document.getElementById("tprice"+no);
    var ttotal = document.getElementById("ttotal"+no);

    var tqty_data=tqty.innerHTML;
    var tconItemNo_data=tconItemNo.innerHTML;
    var tcusItemNo_data=tcusItemNo.innerHTML;
    var tdesc_data=tdesc.innerHTML;
    var tcol_data=tcol.innerHTML;
    var tsize_data=tsize.innerHTML;
    var tpacking_data=tpacking.innerHTML;
    var tprice_data=tprice.innerHTML;
    var ttotal_data=ttotal.innerHTML;

    tqty.innerHTML="<input type='text' id='name_text"+no+"' value='"+tqty_data+"' name>";
    tconItemNo.innerHTML="<input type='text' id='name_text"+no+"' value='"+tconItemNo_data+"'>";
    tcusItemNo.innerHTML="<input type='text' id='name_text"+no+"' value='"+tcusItemNo_data+"'>";
    tdesc.innerHTML="<input type='text' id='name_text"+no+"' value='"+tdesc_data+"'>";
    tcol.innerHTML="<input type='text' id='name_text"+no+"' value='"+tcol_data+"'>";
    tsize.innerHTML="<input type='text' id='name_text"+no+"' value='"+tsize_data+"'>";
    tpacking.innerHTML="<input type='text' id='name_text"+no+"' value='"+tpacking_data+"'>";
    tprice.innerHTML="<input type='text' id='name_text"+no+"' value='"+tprice_data+"'>";
    ttotal.innerHTML="<input type='text' id='country_text"+no+"' value='"+ttotal_data+"'>";

  }*/

   /* function Remove(button) {
            //Determine the reference of the Row using the Button.
            var row = button.parentNode.parentNode;
            var name = row.getElementsByTagName("TD")[3].innerHTML;
            if (confirm("Do you want to delete: " + name)) {

                //Get the reference of the Table.
                var table = document.getElementById("tblCustomers");

                //Delete the Table row using it's Index.
                table.deleteRow(row.rowIndex);
              }
            }; */





            <tr>
                    <td></td>
                    <td><input type="number" id="tqty" ></td>
                    <td><input type="text" id="tconItemNo" ></td>
                    <td><input type="text" id="tcusItemNo" ></td>
                    <td><input type="text" id="tdesc" ></td>
                    <td><input type="text" id="tcol" ></td>
                    <td><input type="text" id="tsize" placeholder="50x70"></td>
                    <td><input type="text" id="tpacking" placeholder="6_63"></td>
                    <td><input type="number" id="tprice" ></td>
                    <td><input type="number" id="ttotal" ></td>
                    <td><input type="button" onclick="Delete()" value="Delete" /></td>
                  </tr>