<?php include('partial/menu.php'); ?>
<div class="clear-fix">
</div>
    <div class="main-content">
        <div class="wrapper"> 
            <h2>Sale Order</h2>
            <br/>
            <a href="<?php echo SITEURL; ?>add-so.php" class="btn-primary">
                Create
            </a>
            <br/><br/>
            <hr/>

            <div class="data-block">

            <table class="tbl-full" style="border-collapse: collapse;">
                <tr>
                    <th>ID</th>
                    <th>Sale Order #</th>
                    <th>Customer</th>
                    <th>Total Price</th>
                    <th>Tax</th>
                    <th>Payment Terms</th>
                    <th>State</th>
                </tr>
            
                <?php 
                    $sql = "SELECT s.*, p.name as customer_name FROM so as s inner join partner as p on p.id = s.customer_id";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count > 0){
                        
                        while($rec = mysqli_fetch_assoc($res)){

                            // echo var_dump($rec);
                            $id = $rec['id'];
                            $name = $rec['name'];
                            $total = $rec['total'];

                            $tax = $rec['tax'];
                            $terms = $rec['terms'];
                            $state = $rec['state'];

                            $customer_id = $rec['customer_name'];
                            ?>
                            <tr onclick="window.location='<?php echo SITEURL; ?>so-detail.php?id=<?php echo $id; ?>';">
                                <td><?php echo $id; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $customer_id; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $tax; ?></td>
                                <td><?php echo $terms; ?></td>
                                <td><?php echo $state; ?></td>
                            </tr>
                            <?php
                        }
                    }else{
                        echo "<span class='fail'>No Data</span>";
                    }
                ?>
            </table>
            </div>
            
        </div>
    </div>
</body>
</html>