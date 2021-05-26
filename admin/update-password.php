<?php
include('partials/menu.php');
?>

    <!--Main-Content Sectin starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Password</h1>
                <br/>
                <br/>
            <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
            ?>

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
                            <td>Current Password:</td>
                            <td><input type="password" name="current_password" placeholder="Current password"></td>
                        </tr>
                        <tr>
                            <td>New Password:</td>
                            <td><input type="password" name="new_password" placeholder="new password "></td>
                        </tr>
                        <tr>
                            <td>Confirm Password:</td>
                            <td><input type="password" name="confirm_password" placeholder="confirm_password"></td>
                        </tr>
                       
                        <tr>
                            
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <input type="submit" name="submit" value="Change Password" class="btn-primary">
                            </td>
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
    // echo "Clicked";
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

$sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

$res=mysqli_query($conn,$sql);

if($res==true)
{
    $count=mysqli_num_rows($res);

    if($count==1)
    {
        // echo "User exists";
        if($new_password==$confirm_password)
        {
            $sql2="UPDATE tbl_admin SET
            password='$new_password'
            WHERE id=$id
            ";
            $res2= mysqli_query($conn,$sql2);

            if($res2==true)
            {
                $_SESSION['change-pwd']="changed password successfully!";
                header("Location:".SITEURL.'admin/manage-admin.php');
            }
            else
            {
                $_SESSION['change-pwd']="Sorry did not changed the password successfully!";
                header("Location:".SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {
            $_SESSION['pwd-not-match']="Sorry password not matched!";
            header("Location:".SITEURL.'admin/manage-admin.php');
        }
    }
    else{
        $_SESSION['user-not-found']="Failed to change password!";
        header("Location:".SITEURL.'admin/manage-admin.php');
    }
}

 }
?>


<?php
include('partials/footer.php');
?>