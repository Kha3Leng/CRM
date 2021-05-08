<?php include('partial/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Update Product Detail</h1>
        <br/><br/>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="submit" name="submit" value="EDIT" class="btn-primary"/>
        <br/>
        <hr/>
            <?php 
                if(isset($_GET['id']) && !empty($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM product where id = $id";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count > 0){
                        if($rec = mysqli_fetch_assoc($res)){
                            $name = $rec['name'];
                            $price = $rec['price'];
                            $qty = $rec['qty'];
                            $pic_name = $rec['picture'];
                            $type = $rec['type'];

                        }

                    }else{
                        $_SESSION['no_such_id'] = "<div class='fail'>No Such ID</div>";
                        header('location:'.SITEURL);
                    }
                }else{
                    header('location:'.SITEURL);
                }
            ?>
            
            <div class="field">
                    <?php
                        if(!empty($pic_name)){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/product_photo/<?php echo $pic_name; ?>" />
                            <?php
                        }else{
                            echo "<div class='fail'>No Image</div>";
                        }
                    ?>
                </div> 
            <div class="detail-box">       
                <div class="field">
                    <label for="name">Name</label><br/>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="hidden" name="pic_name" value="<?php echo $pic_name; ?>"/>
                    <input type="text" require name="name" value="<?php echo $name;?>"/>
                </div>
                <div class="field">
                    <label for="qty">Qty</label><br/>
                    <input type="number" require name="qty"  value="<?php echo $qty;?>"/>
                </div>
                <div class="field">
                    <label for="price">Price</label><br/>
                    <input type="number" require name="price"  value="<?php echo $price;?>"/>
                </div>
                
            </div>
            <div class="detail-box">
                <div class="field">
                    <label for="type">Type</label><br/>
                    <select name="type">
                        <option value="Stockable" <?php echo $type == 'Stockable'? 'selected': ''; ?>>Stockable</option>
                        <option value="Service" <?php echo $type == 'Service'? 'selected': ''; ?>>Service</option>
                    </select>
                </div>
                <div class="field">
                    <label for="picture">Select Picture</label><br/>
                    <input type="file" name="picture"/>
                </div>
            </div>
</form>
<?php
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $type = $_POST['type'];
        $qty =$_POST['qty'];
        $pic = $_POST['pic_name'];
        $id = $_POST['id'];

        if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != ''){
            $pic_name = $_FILES['picture']['name'];
            $src_path = $_FILES['picture']['tmp_name'];

            $ext = end(explode('.', $pic_name));
            $pic_name = "product_photo_".rand(000,999).'.'.$ext;
            $des_path = "images/product_photo/".$pic_name;
            // echo $des_path;
            $upload = copy($src_path, $des_path);
            if($upload == false){
                $_SESSION['upload'] = '<div class="fail">Failed to Upload Product Photo</div>';
                header("location:".SITEURL.'product.php');
            }
            // print_f(!empty($pic));
            // echo var_dump(!empty($pic))
            if (!empty($pic)){
                $path = "images/product_photo/".$pic;
                $remove  = unlink($path);
                echo $path;
                echo $pic;
                echo var_dump($remove);
                if(!$remove){
                    $_SESSION['remove'] = '<div class="fail">Failed to Remove Image</div>';
                    header('location:'.SITEURL.'product.php');
                }
            }
        }else{
            $pic_name = $pic;
        }
        
        echo $pic_name;
        $sql1 = "UPDATE product SET
                    name = '$name', 
                    qty = '$qty', 
                    price = '$price', 
                    type = '$type',
                    picture = '$pic_name'
                WHERE id = $id";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true){
            $_SESSION['update_product'] = "<div class='success'>Update successfully</div>";
            header("location:".SITEURL.'product-detail.php?id='.$id);
        }else{
            $_SESSION['update_product'] = "<div class='fail'>Failed to Update</div>";
            header("location:".SITEURL.'product.php');
        }

    }
?>
</div>
</div>