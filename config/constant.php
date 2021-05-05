<?php
    session_start();

    define("SITEURL", 'http://192.168.64.2/crm/');
    define('LOCALHOST', 'localhost');
    define('DB_USER', 'root');
    define('DB', 'crm');
    define('PW', '');

    $conn = mysqli_connect(LOCALHOST, DB_USER, PW, DB);
    if (mysqli_connect_errno()){
        echo "Failed to connect to mysql database : ".mysqli_connect_errno();
    }
?>