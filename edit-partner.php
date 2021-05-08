<?php include('partial/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Update Partner Detail</h1>
        <br/><br/>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="submit" name="submit" value="EDIT" class="btn-primary"/>
        <br/>
        <hr/>
            <?php 
                if(isset($_GET['id']) && !empty($_GET['id'])){
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM partner where id = $id";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count > 0){
                        if($rec = mysqli_fetch_assoc($res)){
                            $name = $rec['name'];
                            $title = $rec['title'];
                            $phone = $rec['phone'];
                            $pic_name = $rec['picture'];
                            $customer = $rec['customer'];
                            $vendor = $rec['vendor'];
                            $address = $rec['address'];
                            $nrc = $rec['nrc'];

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
                            <img src="<?php echo SITEURL; ?>images/customer_photo/<?php echo $pic_name; ?>" />
                            <?php
                        }else{
                            echo "<div class='fail'>No Image</div>";
                        }
                    ?>
                </div> 
            <div class="detail-box">       
                <div class="field">
                    <label for="customer_name">Name</label><br/>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="hidden" name="pic_name" value="<?php echo $pic_name; ?>"/>
                    <input type="text" require name="customer_name" value="<?php echo $name;?>"/>
                </div>
                <div class="field">
                    <label for="phone">Phone</label><br/>
                    <input type="text" require name="phone"  value="<?php echo $phone;?>"/>
                </div>
                <div class="field">
                    <label for="adr">Address</label><br/>
                    <input type="text" require name="adr"  value="<?php echo $address;?>"/>
                </div>
                <div class="field">
                    <label for="initial">Initial</label><br/>
                    <select name="initial">
                        <option value="Mr" <?php echo $title == 'Mr'? 'selected': ''; ?>>Mr</option>
                        <option value="Master" <?php echo $title == 'Master'? 'selected': ''; ?>>Master</option>
                        <option value="Ms" <?php echo $title == 'Ms'? 'selected': ''; ?>>Ms</option>
                        <option value="Mrs" <?php echo $title == 'Mrs'? 'selected': ''; ?>>Mrs</option>
                        <option value="Madam" <?php echo $title == 'Madam'? 'selected': ''; ?>>Madam</option>
                    </select>
                </div>
            </div>
            <div class="detail-box">
                <div class="field">
                    <label for="nrc">NRC</label><br/>
                    <input type="text" name="nrc" value="<?php echo $nrc;?>"/>
                </div>
                <div class="field">
                    <label for="customer">Customer</label><br/>
                    <input type="checkbox" name="customer" value="customer" <?php echo $customer == 'customer'? 'checked': null;?>/>
                </div>
                <div class="field">
                    <label for="vendor">Vendor</label><br/>
                    <input type="checkbox" name="vendor" value="vendor" <?php echo $vendor == 'vendor'? 'checked': null;?>/>
                </div>
                <div class="field">
                    <label for="picture">Select Picture</label><br/>
                    <input type="file" name="picture"/>
                </div>
            </div>
</form>
<?php
    if(isset($_POST['submit'])){
        $name = $_POST['customer_name'];
        $initial = $_POST['initial'];
        $nrc =$_POST['nrc'];
        $pic = $_POST['pic_name'];
        $id = $_POST['id'];

        if (isset($_POST['customer'])){
            $customer = $_POST['customer'];
        }else{
            $customer = 'null';
        }

        if (isset($_POST['vendor'])){
            $vendor = $_POST['vendor'];
        }else{
            $vendor = 'null';
        }
        $phone = $_POST['phone'];
        $adr = $_POST['adr'];
        // print_r($_FILES['picture']);

        if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != ''){
            $pic_name = $_FILES['picture']['name'];
            $src_path = $_FILES['picture']['tmp_name'];

            $ext = end(explode('.', $pic_name));
            $pic_name = $name."_photo_".rand(000,999).'.'.$ext;
            $des_path = "images/customer_photo/".$pic_name;
            // echo $des_path;
            $upload = copy($src_path, $des_path);
            if($upload == false){
                header("location:".SITEURL);
            }
            // print_f(!empty($pic));
            // echo var_dump(!empty($pic))
            if (!empty($pic)){
                $path = "images/customer_photo/".$pic;
                $remove  = unlink($path);
                echo $path;
                echo $pic;
                echo var_dump($remove);
                if(!$remove){
                    $_SESSION['remove'] = '<div class="fail">Failed to Remove Image</div>';
                    header('location:'.SITEURL);
                }
            }
        }else{
            $pic_name = $pic;
        }
        
        echo $pic_name;
        $sql1 = "UPDATE partner SET
                    name = '$name', 
                    title = '$initial', 
                    phone = '$phone', 
                    customer = '$customer', 
                    vendor = '$vendor', 
                    address = '$address', 
                    nrc = '$nrc', 
                    picture = '$pic_name'
                WHERE id = $id";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true){
            $_SESSION['update_partner'] = "<div class='success'>Update successfully</div>";
            header("location:".SITEURL.'partner-detail.php?id='.$id);
        }else{
            $_SESSION['update_partner'] = "<div class='fail'>Failed to Update</div>";
            header("location:".SITEURL);
        }

    }
?>
</div>
</div>