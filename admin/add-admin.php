<?php
include('partials/menu.php');
?>


    <!--Main-Content Sectin starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add admin</h1>
                <br/>
                <br/>
            <?php
            
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
            <br/><br/><br/>
                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Full name:</td>
                            <td><input type="text" name="full_name" placeholder="Enter your full name "></td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" placeholder="Enter a username "></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password" placeholder="Enter a password "></td>
                        </tr>
                       
                        <tr>
                            
                            <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-primary"></td>
                        </tr>
                    </table>
                </form>
            <div class="clearfix"></div>

        </div>
    </div>
    <!--Main-content Sectin ends-->



<?php

if(isset($_POST['submit']))
{
    //Button is clicked;

    //1.Taking the valus from Form;
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);//Password encreapted with MD5;

    //Making Connection with my database;

    

    //2.sql quarry to save the data;

     $sql="INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'

    ";

    //3.Execute quarry and save data to database

    $res=mysqli_query($conn,$sql) or die("Quarry not executed!");

    //4.checking

    if($res=TRUE)
    {
        $_SESSION['add']="Admin added successfully";
        header("Location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['add']="Failed to add!";
        header("Location:".SITEURL.'admin/add-admin.php');
    }

}


?>
<?php
include('partials/footer.php');
?>