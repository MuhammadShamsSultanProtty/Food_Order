<?php

    session_start();

    define('SITEURL','http://localhost/food-order/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_NAME','food-order');
    define('PASSWORD','');
    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,PASSWORD) or die("Database not connected");
    $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
?>