<?php
    include('config/constant.php');

    if (isset($_GET['id']) && $_GET['id'] != ''){
        $id = $_GET['id'];

        $sql = "SELECT * FROM partner WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res)==1){
            if($rec = mysqli_fetch_assoc($res)){
                $pic_name = $rec['picture'];

                if($pic_name != ''){
                    $path = 'images/customer_photo/'.$pic_name;
                    $remove = unlink($path);
                    if($remove == false){
                        $_SESSION['remove'] = "<div class='fail'>Cannot remove image</div>";
                        header('location:'.SITEURL);
                        die();
                    }
                }

                $sql1 = "DELETE FROM partner WHERE id = $id";
                $res1 = mysqli_query($conn, $sql1);
                if ($res1 == true){
                    $_SESSION['remove'] = "<div class='success'>Removed</div>";
                    header('location:'.SITEURL.'partner-detail.php');
                }
            }
        }else{

        }

    }else{
        header('location:'.SITEURL);
    }
?>