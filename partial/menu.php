<?php include('config/constant.php'); ?>
<html>
<head>
    <title>CRM K</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>

<body>
    <div class="menu">

        <?php 
            $currentPage= $_SERVER['SCRIPT_NAME'];
            $current_file = end(explode('/', $currentPage));
        ?>
        <a href="<?php echo SITEURL; ?>" class="logo <?php echo ($current_file == 'index.php')? "active": '';?>">
            <img src="images/logo.jpg" alt="Leang CRM"/>
            <h2 class="text-center">Learg CRM</h2>
        </a>
        <navbar>
            <ul>
                <li><a href="<?php echo SITEURL; ?>lead.php" class="<?php echo ($current_file == 'lead.php')? "active": ''; ?>">Lead</a></li>
                <li><a href="<?php echo SITEURL; ?>customer.php" class="<?php echo ($current_file == 'customer.php')? "active": ''; ?>">Customers</a></li>
                <li><a href="<?php echo SITEURL; ?>vendor.php" class="<?php echo ($current_file == 'vendor.php')? "active": ''; ?>">Vendor</a></li>
                <li><a href="<?php echo SITEURL; ?>product.php" class="<?php echo ($current_file == 'product.php')? "active": ''; ?>">Product</a></li>
                <li><a href="<?php echo SITEURL; ?>sale_order.php" class="<?php echo ($current_file == 'sale_order.php')? "active": ''; ?>">Sale Order</a></li>
            </ul>
        </navbar>

        <div class="footer">
            <p> CRM &copy; – 2014-<?php echo date('Y');?></p>
        </div>
    </div>