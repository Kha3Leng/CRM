<?php include('partial/menu.php'); ?>
<div class="clear-fix">
</div>
    <div class="main-content">
        <div class="wrapper"> 
            <h2>Product</h2>
            <br/>   
            <?php
                if(isset($_SESSION['no_product'])){
                    echo $_SESSION['no_product'];
                    unset($_SESSION['no_product']);
                }

                if(isset($_SESSION['add_product'])){
                    echo $_SESSION['add_product'];
                    unset($_SESSION['add_product']);
                }

                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['update_product'])){
                    echo $_SESSION['update_product'];
                    unset($_SESSION['update_product']);
                }
            ?>
            <a href="<?php echo SITEURL; ?>add-product.php" class="btn-primary">
                Create
            </a>
            <br/><br/>
            <hr/>

            <div class="data-block">
            
            <?php 
                $sql = "SELECT * FROM product";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count > 0){
                    while($rec = mysqli_fetch_assoc($res)){
                        $name = $rec['name'];
                        $type = $rec['type'];
                        $price = $rec['price'];
                        $qty = $rec['qty'];
                        $pic_name = $rec['picture'];
                        $id = $rec['id'];
                        ?>
                        <a  href ="<?php echo SITEURL; ?>product-detail.php?id=<?php echo $id; ?>">
                            <div class="customer-card">
                            <?php 
                                if($pic_name != ''){
                            ?>
                                <img src="<?php echo SITEURL; ?>images/product_photo/<?php echo $pic_name;?>" alt="No Image" width="100px" height="100px"/>
                                <?php
                                }else{
                                    echo "<img alt='No Image' width='100px' height='100px'/>";
                                }
                                ?>
                                <strong class="text-center">ID</strong><br>
                                <span><?php echo $id; ?></span><br/><br/>
                                <strong class="text-center">Name</strong><br>
                                <span><?php echo $name; ?></span><br/> <br/>
                                <strong class="text-center">Price</strong><br>
                                <span><?php echo $price; ?></span><br/> <br/>
                                <strong class="text-center">Qty</strong><br>
                                <span><?php echo $qty; ?></span><br/> <br/> 
                                <strong class="text-center">Type</strong><br>
                                <span><?php echo $type; ?></span><br/> <br/>                       
                                
                            </div>
                        </a>
                        <?php
                    }
                }else{
                    echo "<div class='fail'>No Data</div>";
                }
            ?>
                
            </div>
            
        </div>
    </div>
</body>
</html>