<?php include('partial/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Product Detail</h1>
        <br/><br/>
        <form action="" method="POST" enctype="multipart/form-data">
        <input type="submit" name="submit" value="CREATE" class="btn-primary"/>
        <br/>
        <hr/>
            <div class="detail-box">
        
                <div class="field">
                    <label for="name">Name</label><br/>
                    <input type="text" require name="name"/>
                </div>
                <div class="field">
                    <label for="price">Price</label><br/>
                    <input type="number" require name="price" />
                </div>
                <div class="field">
                    <label for="type">Type</label><br/>
                    <select name="type">
                        <option value="Stockable">Stockable</option>
                        <option value="Service">Service</option>
                    </select>
                </div>
            </div>
            <div class="detail-box">
                <div class="field">
                    <label for="qty">Qty</label><br/>
                    <input type="number" name="qty"/>
                </div>
                <div class="field">
                    <label for="picture">Select Picture</label><br/>
                    <input type="file" name="picture"/>
                </div>
            </div>
</form>
<?php
    if(isset($_POST['submit'])){
        echo $name = $_POST['name'];
        echo $qty =$_POST['qty'];
        echo $price = $_POST['price'];

        if (isset($_POST['type'])){
            $type = $_POST['type'];
        }else{
            $type = 'null';
        }

        if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != ''){
            $pic_name = $_FILES['picture']['name'];
            $src_path = $_FILES['picture']['tmp_name'];

            $ext = end(explode('.', $pic_name));
            $pic_name = "product_photo_".rand(000,999).'.'.$ext;
            $des_path = "images/product_photo/".$pic_name;
            // echo $des_path;
            $upload = copy($src_path, $des_path);
            echo $upload;
            if($upload == false){
                header("location:".SITEURL);
            }
        }else{
            $pic_name = '';
        }
        echo $pic_name;
        $sql = "INSERT INTO product 
                (name, type, price, qty, picture)
                VALUES('$name', '$type', $price, $qty, '$pic_name')";
        $res = mysqli_query($conn, $sql);
        $id = mysqli_insert_id($conn);
        echo $sql;
        echo var_dump($res);
        if ($res == true){
            $_SESSION['add_product'] = "<div class='success'>Create a new product successfully</div>";
            header("location:".SITEURL.'product-detail.php?id='.$id);
        }else{
            $_SESSION['add_product'] = "<div class='fail'>Create a new parnter Failed</div>";
            header("location:".SITEURL.'product.php');
        }

    }
?>
</div>
</div>