<?php
    include('partial/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Sale Order</h1>
        <br/><br/>
        <a href="<?php echo SITEURL; ?>add-so.php" class="btn-primary">CREATE</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo SITEURL; ?>edit-product.php?id=<?php echo $_GET['id']; ?>" class="btn-primary">EDIT</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo SITEURL; ?>delete-product.php?id=<?php echo $_GET['id']; ?>" class="btn-primary">DELETE</a>
        <br/><br/>
        <hr/>
        <?php
            if(isset($_GET['id']) && $_GET['id'] != ''){
                $id = $_GET['id'];
                
                $sql = "SELECT s.*, p.name as customer_name, p.address FROM so as s inner join partner p WHERE s.id = $id and s.customer_id = p.id";
                $res = mysqli_query($conn, $sql);
                if( $res == true){
                    if($rec = mysqli_fetch_assoc($res)){
                        $name = $rec['name'];
                        $total = $rec['total'];
                        $tax = $rec['tax'];
                        $customer_name = $rec['customer_name'];
                        $terms = $rec['terms'];
                        $state = $rec['state'];
                        $address = $rec['address'];
                    }
                }
            }else{
                header('location:'.SITEURL.'sale_order.php');
            }
        ?>
        <div class="detail-box">
    
            <div class="field">
                <label for="name">Name</label><br/>
                <input readonly type="text" name="name" value='<?php echo $name;?>'/>
            </div>
            <div class="field">
                <label for="address">Address</label><br/>
                <input readonly type="text" name="address" value='<?php echo $address; ?>'/>
            </div>
            <div class="field">
                <label for="total">Total</label><br/>
                <input readonly type="number" name="total" value='<?php echo $total; ?>'/>
            </div>
            <div class="field">
                <label for="tax">Tax</label><br/>
                <input readonly type="number" name="tax" value='<?php echo $tax; ?>'/>
            </div>
        </div>
        <div class="detail-box">
            <div class="field">
                <label for="customer_id">Customer</label><br/>
                <input readonly type="text" name="customer_id" value='<?php echo $customer_name;?>'/>
            </div>
            <div class="field">
                <label for="terms">Terms</label><br/>
                <input readonly type="text" name="terms" value='<?php echo $terms;?>'/>
            </div>
            <div class="field">
                <label for="state">State</label><br/>
                <input readonly type="text" name="state" value='<?php echo $state;?>'/>
            </div>
        </div>
        <div class="clear-fix"></div>
        <hr/>
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            <?php
                $sql1 = "SELECT s.*, p.name as product_name FROM sol as s, product as p WHERE order_id = $id and p.id = s.product_id";
                // echo $sql1;
                $res1 = mysqli_query($conn, $sql1);
                $count = mysqli_num_rows($res1);

                if ($count > 0){
                    while($rec = mysqli_fetch_assoc($res1)){
                        $sol_id = $rec['id'];
                        $qty = $rec['ordered_qty'];
                        $total = $rec['total'];
                        $product_id = $rec['product_id'];
                        $price = $rec['price'];
                        $product_name = $rec['product_name'];
                        ?>
                        <tr>
                            <td><?php echo $sol_id; ?></td>
                            <td><?php echo $product_name; ?></td>
                            <td><?php echo number_format($price); ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo number_format($total); ?></td>
                        </tr>
                        <?php

                    }
                }
            ?>
        </table>
    </div>
</div>
