

<?php
    include('../config/constants.php');
    //1.Get the admin id to be deleted;
    $id=$_GET['id'];
    //2.Run sql query;
    $sql="DELETE FROM tbl_admin WHERE id=$id";
    //3.Redirect the page and show message;
    $res=mysqli_query($conn,$sql);

    if($res==true)
    {
        //echo "Deleted!";
        $_SESSION['delete']="<div class ='sucess'>Admin deleted Sucessfully<div/>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
       // echo "failed";
       $_SESSION['delete']="<div class ='error'>Sorry failed to delete admin!<div/>";
       header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>