<?php
    include('partial/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Customer Detail</h1>
        <br/><br/>
        <a href="#" class="btn-secondary">Edit</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" class="btn-secondary">Delete</a>
        <br/>
        <hr/>
        <div class="field">
                <img src="images/customer_photo/john.jpeg"/>
            </div>
        <div class="detail-box">
    
            <div class="field">
                <label for="customer_name">Name</label><br/>
                <input type="text" name="customer_name" value='Hello'/>
            </div>
            <div class="field">
                <label for="phone">Phone</label><br/>
                <input type="text" name="phone" value='Hello'/>
            </div>
            <div class="field">
                <label for="adr">Address</label><br/>
                <input type="text" name="adr" value='Hello'/>
            </div>
            <div class="field">
                <label for="initial">Initial</label><br/>
                <input type="text" name="initial" value='Hello'/>
            </div>
        </div>
        <div class="detail-box">
            <div class="field">
                <label for="nrc">NRC</label><br/>
                <input type="text" name="nrc" value='Hello'/>
            </div>
            <div class="field">
                <label for="customer">Customer</label><br/>
                <input type="text" name="customer" value='Hello'/>
            </div>
            <div class="field">
                <label for="vendor">Vendor</label><br/>
                <input type="text" name="vendor" value='Hello'/>
            </div>
        </div>
    </div>
</div>
