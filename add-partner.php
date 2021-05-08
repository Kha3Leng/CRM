<?php include('partial/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Customer Detail</h1>
        <br/><br/>
        <form action="" method="POST" enctype="multipart/form-data">
        <input type="submit" name="submit" value="CREATE" class="btn-primary"/>
        <br/>
        <hr/>
            <div class="detail-box">
        
                <div class="field">
                    <label for="customer_name">Name</label><br/>
                    <input type="text" require name="customer_name"/>
                </div>
                <div class="field">
                    <label for="phone">Phone</label><br/>
                    <input type="text" require name="phone" />
                </div>
                <div class="field">
                    <label for="adr">Address</label><br/>
                    <input type="text" require name="adr" />
                </div>
                <div class="field">
                    <label for="initial">Initial</label><br/>
                    <select name="initial">
                        <option value="Mr">Mr</option>
                        <option value="Master">Master</option>
                        <option value="Ms">Ms</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Madam">Madam</option>
                    </select>
                </div>
            </div>
            <div class="detail-box">
                <div class="field">
                    <label for="nrc">NRC</label><br/>
                    <input type="text" name="nrc"/>
                </div>
                <div class="field">
                    <label for="customer">Customer</label><br/>
                    <input type="checkbox" name="customer" value="customer"/>
                </div>
                <div class="field">
                    <label for="vendor">Vendor</label><br/>
                    <input type="checkbox" name="vendor" value="vendor"/>
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
            echo $upload;
            if($upload == false){
                header("location:".SITEURL);
            }
        }else{
            $pic_name = '';
        }
        echo $pic_name;
        $sql = "INSERT INTO partner 
                (name, title, phone, customer, vendor, address, nrc, picture)
                VALUES('$name', '$initial', '$phone', '$customer', '$vendor', '$adr', '$nrc', '$pic_name')";
        $res = mysqli_query($conn, $sql);
        $id = mysqli_insert_id($conn);
        if ($res == true){
            $_SESSION['add_partner'] = "<div class='success'>Create a new parnter successfully</div>";
            header("location:".SITEURL.'partner-detail.php?id='.$id);
        }else{
            $_SESSION['add_partner'] = "<div class='fail'>Create a new parnter Failed</div>";
            header("location:".SITEURL);
        }

    }
?>
</div>
</div>