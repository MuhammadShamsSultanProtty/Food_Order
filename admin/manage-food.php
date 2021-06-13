<?php
include('partials/menu.php');
?>

    <!--Main-Content Sectin starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Food Management</h1>

            
            <br/><br/>
                <a href="<?php echo SITEURL?>admin/add-food.php" class="btn-primary">Add Food</a>
            <br/><br/>
            <table class="tbl-full">
                <tr>
                    <th>S.L</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Shams</td>
                    <td>Admin</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delet Admin</a>
                    </td>
                </tr>
            </table>

            <div class="clearfix"></div>

        </div>
    </div>
    <!--Main-content Sectin ends-->

<?php
include('partials/footer.php');
?>