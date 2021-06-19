<?php include('../config/constants.php')?>
<html>
<head>

    <title>Login!</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body >
   <div class="login text-center">
       <h1>Login</h1><br/><br/>
       <?php
       if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>
       <br/><br/>
       <!--Login form starts here-->
       <form action="" method="POST">
           <b>Username:</b><br/>
           <input type="text" name="username" placeholder="Enter username"><br/><br/>
           <b>Password:</b><br/>
           <input type="password" name="password" placeholder="Enter password"><br/><br/>
           <input type="submit" name="submit" value="Login" class="btn-primary"><br/><br/>
       </form>
       <!--Login form ends here-->
       <p>Created by: <a href="#">Shams Sultan</a></p>
   </div> 
</body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password =md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class = 'sucess'>Login Successful</div>";
            $_SESSION['user']=$username;
            header('location:'.SITEURL.'admin/');
        }
        else{
            // $_SESSION['login'] = "<div class = 'sucess'>Login Successful</div>";
            // $_SESSION['user']=$username;
            // header('location:'.SITEURL.'admin/');
            $_SESSION['login'] = "<div class = 'error'>Username or password did not matched!</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>