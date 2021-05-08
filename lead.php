<?php include('partial/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Lead Info</h1>
            <a href="<?php echo SITEURL; ?>customer.php" class="lead-card text-center">
                Customer<br/>
                <?php
                    $sql = "SELECT count(*) as countc FROM partner WHERE customer='customer'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_fetch_assoc($res)['countc'];
                    echo $count;
                ?>
            </a>
            
            <a href="<?php echo SITEURL; ?>vendor.php" class="lead-card text-center">
                Vendor<br/>
                <?php
                    $sql1 = "SELECT count(*) as countv FROM partner WHERE vendor='vendor'";
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_fetch_assoc($res1)['countv'];
                    echo $count1;
                ?>
            </a>

            <a href="<?php echo SITEURL; ?>product.php" class="lead-card text-center">
                Product<br/>
                <?php
                    $sql2 = "SELECT count(*) as countp FROM product WHERE type='stockable'";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_fetch_assoc($res2)['countp'];
                    echo empty($count2)? 0: $count2;
                ?>
            </a>

            <a href="<?php echo SITEURL; ?>customer.php" class="lead-card text-center">
                Customer<br/>
                <?php
                    $sql = "SELECT count(*) as countc FROM partner WHERE customer='customer'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_fetch_assoc($res)['countc'];
                    echo $count;
                ?>
            </a>


        </div>
    </div>
</body>
</html>