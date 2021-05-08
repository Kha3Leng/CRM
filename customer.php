<?php include('partial/menu.php'); ?>
<div class="clear-fix">
</div>
    <div class="main-content">
        <div class="wrapper"> 
            <h2>Customers</h2>
            <br/>   
            <?php
                if(isset($_SESSION['no_customer'])){
                    echo $_SESSION['no_customer'];
                    unset($_SESSION['no_customer']);
                }
            ?>
            <a href="<?php echo SITEURL; ?>add-partner.php?id=" class="btn-primary">
                Create
            </a>
            <br/><br/>
            <hr/>

            <div class="data-block">
            
            <?php 
                $sql = "SELECT * FROM partner WHERE customer = 'customer'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count > 0){
                    while($rec = mysqli_fetch_assoc($res)){
                        $pic_name = $rec['picture'];
                        $id = $rec['id'];
                        $name = $rec['name'];
                        $address = $rec['address'];
                        $phone = $rec['phone'];
                        ?>
                        <a  href ="<?php echo SITEURL; ?>partner-detail.php?id=<?php echo $id; ?>">
                            <div class="customer-card">
                            <?php 
                                if($pic_name != ''){
                            ?>
                                <img src="<?php echo SITEURL; ?>images/customer_photo/<?php echo $pic_name;?>" alt="No Image" width="100px" height="100px"/>
                                <?php
                                }else{
                                    echo "<img alt='No Image' width='100px' height='100px'/>";
                                }
                                ?>
                                <strong class="text-center">ID</strong><br>
                                <span><?php echo $id; ?></span><br/><br/>
                                <strong class="text-center">Name</strong><br>
                                <span><?php echo $name; ?></span><br/> <br/>
                                <strong class="text-center">Address</strong><br>
                                <span><?php echo $address; ?></span><br/> <br/>
                                <strong class="text-center">Phone</strong><br>
                                <span><?php echo $phone; ?></span><br/> <br/>                       
                                
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