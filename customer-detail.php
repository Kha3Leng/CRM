<?php
    include('partial/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Customer Detail</h1>
        <br/><br/>
        <a href="<?php echo SITEURL; ?>add-partner.php" class="btn-primary">CREATE</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" class="btn-primary">EDIT</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" class="btn-primary">DELETE</a>
        <br/>
        <hr/>
        <?php
            if(isset($_GET['id']) && $_GET['id'] != ''){
                $id = $_GET['id'];
                
                $sql = "SELECT * FROM partner WHERE id = $id";
                $res = mysqli_query($conn, $sql);
                if( $res == true){
                    if($rec = mysqli_fetch_assoc($res)){
                        $name = $rec['name'];
                        $title = $rec['title'];
                        $phone = $rec['phone'];
                        $pic_name = $rec['picture'];
                        $customer = $rec['customer'];
                        $vendor = $rec['vendor'];
                        $address = $rec['address'];
                        $nrc = $rec['nrc'];
                    }
                }
            }else{
                $_SESSION['no_customer'] = '<div class="fail">No Customers</div>';
                header('location:'.SITEURL.'customer.php');
            }
        ?>
        <div class="field">
            <?php
                    if ($pic_name != ''){
            ?>
                <img src="<?php echo SITEURL; ?>images/customer_photo/<?php echo $pic_name;?>"/>
                <?php
                    }else{
                        echo "<div class='fail text-center'>No Image</div>";
                    }
                ?>
            </div>
        <div class="detail-box">
    
            <div class="field">
                <label for="customer_name">Name</label><br/>
                <input readonly type="text" name="customer_name" value='<?php echo $name;?>'/>
            </div>
            <div class="field">
                <label for="phone">Phone</label><br/>
                <input readonly type="text" name="phone" value='<?php echo $phone; ?>'/>
            </div>
            <div class="field">
                <label for="adr">Address</label><br/>
                <input readonly type="text" name="adr" value='<?php echo $address;?>'/>
            </div>
            <div class="field">
                <label for="initial">Initial</label><br/>
                <input readonly type="text" name="initial" value='<?php echo $title;?>'/>
            </div>
        </div>
        <div class="detail-box">
            <div class="field">
                <label for="nrc">NRC</label><br/>
                <input readonly type="text" name="nrc" value='<?php echo $nrc; ?>'/>
            </div>
            <div class="field">
                <label for="customer">Customer</label><br/>
                <?php
                    if($customer == 'customer'){
                        echo "<input onclick='return false;' type='checkbox' name='customer' checked/>";
                    }else{
                        echo "<input onclick='return false;' type='checkbox' name='customer'/>";
                    }
                ?>
                
            </div>
            <div class="field">
                <label for="vendor">Vendor</label><br/>
                <?php
                    if($vendor == 'vendor'){
                        echo "<input onclick='return false;' type='checkbox' name='vendor' checked/>";
                    }else{
                        echo "<input onclick='return false;' type='checkbox' name='vendor'/>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
