<?php 
include('partial/menu.php');
if(!isset($GLOBALS['sequence'])){
    $GLOBALS['sequence'] = 1;  
}
?>

<script>
        function unit_price(){
                var option = document.getElementById('product').value;
                console.log(option);
                return option;
            }
		function addRow(tableID) {
            
			var table = document.getElementById(tableID);
            
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var cell1 = row.insertCell(0);
            cell1.setAttribute("id", "handler");
			var element1 = document.createElement("input");
			element1.type = "checkbox";
			element1.name="chkbox[]";
			cell1.appendChild(element1);

			var cell2 = row.insertCell(1);
            var element2 = document.createElement("select");
            element2.setAttribute("id", "product");
            element2.setAttribute("onchange", "unit_price();");
            <?php
                $query = "SELECT * from product";
                $rs = mysqli_query($conn, $query );
                
                $count = mysqli_num_rows($rs);
                $values = array();
                while($rec = mysqli_fetch_assoc($rs)){
                    $values[] = $rec;
                }
            ?>
            var product_len = parseInt("<?php echo $count; ?>", 10);
            console.log(typeof(product_len));
            var z;
            var values = <?php echo json_encode($values)?>;
            console.log(values);
            for (var key in values) {
                if (values.hasOwnProperty(key)) {
                    z = document.createElement("option");
                    z.value = values[key]['id'];
                    z.text = values[key]['name'];
                    element2.appendChild(z);
                    console.log(key + " -> " + values[key]['id']);
                }
            }
            cell2.appendChild(element2);

			var cell3 = row.insertCell(2);
			var element3 = document.createElement("input");
            element3.setAttribute('id', 'price');
			element3.type = "number";
			element3.name = "txtbox[]";

			cell3.appendChild(element3);

            var cell4 = row.insertCell(3);
			var element4 = document.createElement("input");
            element4.setAttribute('id', 'qty');
			element4.type = "number";
			element4.name = "txtbox[]";
			cell4.appendChild(element4);

            var cell5 = row.insertCell(4);
			var element5 = document.createElement("input");
            element5.setAttribute('id', 'total');
			element5.type = "number";
            element5.readonly = true;
			element5.name = "txtbox[]";
			cell5.appendChild(element5);

		}

        function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}
</script>

<div class="main-content">
    <div class="wrapper">
    <h1>Sale Order</h1>
        <br/><br/>
        <?php
            if(isset($_SESSION['customer_id'])){
                echo $_SESSION['customer_id'];
                unset($_SESSION['customer_id']);
            }
        ?>
        <br/><br/>
        <form action="" method="POST" enctype="multipart/form-data">
        <input type="submit" name="submit" value="CREATE" class="btn-primary"/>
        <br/>
        <hr/>
            <div class="detail-box">
        
                <div class="field">
                    <label for="name">Name</label><br/>
                    <span name="name">&nbsp;&nbsp;&nbsp;&nbsp;New</span>
                </div>
                <div class="field">
                    <label for="customer_id">Customer</label><br/>
                    <select name="customer_id">
                    <?php
                        $sql = "SELECT * from partner where customer='customer'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count > 0 ){
                            while($rec = mysqli_fetch_array($res)){
                                $id = $rec['id'];
                                $name = $rec['name'];
                                echo $id;
                                echo $name;
                                echo "<option value=".$id.">".$name."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="detail-box">
                <div class="field">
                    <label for="terms">Terms</label><br/>
                    <input type="text" name="terms"/>
                </div>

                <div class="field">
                    <label for="tax">Tax</label><br/>
                    <input type="number" name="tax"/>
                </div>
            </div>
            <br/>
            <br/>
            <div class="clear-fix"></div>
            <hr>
            <input type="button" class="btn-secondary" value="Add New" onclick="addRow('sol')"/>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" class="btn-secondary" value="Delete Row" onclick="deleteRow('sol')"/>
            <br/>
            <table class="tbl-full" id="sol">
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </table>
</form>
<?php
    if(isset($_POST['submit'])){
        echo $terms =$_POST['terms'];
        echo $tax = $_POST['tax'];

        if (isset($_POST['customer_id'])){
            $customer_id = $_POST['customer_id'];
        }else{
            $_SESSION['customer_id'] = "<div class='fail'>Customer is required</div>";
            header("location:".SITEURL."add-so.php");
        }

        
        $name = 'SO0000'.$GLOBALS['sequence'];
        $GLOBALS['sequence'] += 1; 

        $sql = "INSERT INTO so 
                (name, total, tax, terms, state, customer_id)
                VALUES('$name', 1000, 100, '$terms', 'draft', $customer_id)";
        $res = mysqli_query($conn, $sql);
        $id = mysqli_insert_id($conn);

        if ($res == true){
            $_SESSION['add_product'] = "<div class='success'>Create a new product successfully</div>";
            header("location:".SITEURL.'sale_order.php');
        }else{
            $_SESSION['add_product'] = "<div class='fail'>Create a new parnter Failed</div>";
            header("location:".SITEURL.'product.php');
        }



    }
?>
</div>
</div>