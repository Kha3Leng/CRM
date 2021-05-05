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
            ?>
        </div>
    </div>
</body>
</html>