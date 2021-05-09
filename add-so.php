<?php 
include('partial/menu.php');
if(!isset($GLOBALS['sequence'])){
    $GLOBALS['sequence'] = 1;  
}
?>

<div class="main-content">
    <div class="wrapper">
    <h1>Sale Order</h1>
        <br/><br/>
        <?php
            if(isset($_SESSION['customer_id'])){
                echo $_SESSION['customer_id'];
                unset($_SESSION['customer_id']);
            }
        ?>
        <br/><br/>
        <form action="" method="POST" enctype="multipart/form-data">
        <input type="submit" name="submit" value="CREATE" class="btn-primary"/>
        <br/>
        <hr/>
            <div class="detail-box">
        
                <div class="field">
                    <label for="name">Name</label><br/>
                    <span name="name">&nbsp;&nbsp;&nbsp;&nbsp;New</span>
                </div>
                <div class="field">
                    <label for="customer_id">Customer</label><br/>
                    <select name="customer_id">
                    <?php
                        $sql = "SELECT * from partner where customer='customer'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count > 0 ){
                            while($rec = mysqli_fetch_array($res)){
                                $id = $rec['id'];
                                $name = $rec['name'];
                                echo $id;
                                echo $name;
                                echo "<option value=".$id.">".$name."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="detail-box">
                <div class="field">
                    <label for="terms">Terms</label><br/>
                    <input type="text" name="terms"/>
                </div>

                <div class="field">
                    <label for="tax">Tax</label><br/>
                    <input type="number" name="tax"/>
                </div>
            </div>
</form>
<?php
    if(isset($_POST['submit'])){
        echo $terms =$_POST['terms'];
        echo $tax = $_POST['tax'];

        if (isset($_POST['customer_id'])){
            $customer_id = $_POST['customer_id'];
        }else{
            $_SESSION['customer_id'] = "<div class='fail'>Customer is required</div>";
            header("location:".SITEURL."add-so.php");
        }

        
        $name = 'SO0000'.$GLOBALS['sequence'];
        $GLOBALS['sequence'] += 1; 

        $sql = "INSERT INTO so 
                (name, total, tax, terms, state, customer_id)
                VALUES('$name', 1000, 100, '$terms', 'draft', $customer_id)";
        $res = mysqli_query($conn, $sql);
        $id = mysqli_insert_id($conn);
        echo $sql;
        echo var_dump($res);
        if ($res == true){
            $_SESSION['add_product'] = "<div class='success'>Create a new product successfully</div>";
            header("location:".SITEURL.'sale_order.php');
        }else{
            $_SESSION['add_product'] = "<div class='fail'>Create a new parnter Failed</div>";
            header("location:".SITEURL.'product.php');
        }

    }
?>
</div>
</div>