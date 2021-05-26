<?php
 if(!isset($_SESSION['user']))//if user session is not set,means not logged in 
 {
     //redirect 
     $_SESSION['no-login-message'] = "<div class='error'>Please login to access admin panel!<div/>";
     header('location:'.SITEURL.'admin/login.php');
 }
 
 ?>