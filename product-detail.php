<?php
    include('partial/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Product Detail</h1>
        <br/><br/>
        <?php
            if(isset($_SESSION['update_product'])){
                echo $_SESSION['update_product'];
                unset($_SESSION['update_product']);
            }
        ?>
        <br/><br/>
        <a href="<?php echo SITEURL; ?>add-product.php" class="btn-primary">CREATE</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo SITEURL; ?>edit-product.php?id=<?php echo $_GET['id']; ?>" class="btn-primary">EDIT</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo SITEURL; ?>delete-product.php?id=<?php echo $_GET['id']; ?>" class="btn-primary">DELETE</a>
        <br/>
        <hr/>
        <?php
            if(isset($_GET['id']) && $_GET['id'] != ''){
                $id = $_GET['id'];
                
                $sql = "SELECT * FROM product WHERE id = $id";
                $res = mysqli_query($conn, $sql);
                if( $res == true){
                    if($rec = mysqli_fetch_assoc($res)){
                        $name = $rec['name'];
                        $price = $rec['price'];
                        $qty = $rec['qty'];
                        $type = $rec['type'];
                        $pic_name = $rec['picture'];
                    }
                }
            }else{
                header('location:'.SITEURL.'product.php');
            }
        ?>
        <div class="field">
            <?php
                    if ($pic_name != ''){
            ?>
                <img src="<?php echo SITEURL; ?>images/product_photo/<?php echo $pic_name;?>"/>
                <?php
                    }else{
                        echo "<div class='fail text-center'>No Image</div>";
                    }
                ?>
            </div>
        <div class="detail-box">
    
            <div class="field">
                <label for="name">Name</label><br/>
                <input readonly type="text" name="name" value='<?php echo $name;?>'/>
            </div>
            <div class="field">
                <label for="price">Price</label><br/>
                <input readonly type="number" name="price" value='<?php echo $price; ?>'/>
            </div>
            
        </div>
        <div class="detail-box">
            <div class="field">
                <label for="qty">Qty</label><br/>
                <input readonly type="number" name="qty" value='<?php echo $qty;?>'/>
            </div>
            <div class="field">
                <label for="type">Type</label><br/>
                <input readonly type="text" name="type" value='<?php echo $type;?>'/>
            </div>
        </div>
    </div>
</div>
