<?php include('partial/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br/><br/><br/>
            <?php
                if(isset($_SESSION['add_partner'])){
                    echo $_SESSION['add_partner'];
                    unset($_SESSION['add_partner']);
                }

                if(isset($_SESSION['no_such_id'])){
                    echo $_SESSION['no_such_id'];
                    unset($_SESSION['no_such_id']);
                }

                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['update_partner'])){
                    echo $_SESSION['update_partner'];
                    unset($_SESSION['update_partner']);
                }
            ?>
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

            <a href="<?php echo SITEURL; ?>sale_order.php" class="lead-card text-center">
                Sale Order<br/>
                <?php
                    $sql3 = "SELECT count(*) as counts FROM so";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_fetch_assoc($res3)['counts'];
                    echo $count3;
                ?>
            </a>
        </div>
    </div>
</body>
</html>