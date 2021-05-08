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
        </div>
    </div>
</body>
</html>