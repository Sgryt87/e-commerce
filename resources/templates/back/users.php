<div class="col-lg-12">


    <h1 class="page-header">
        Users

    </h1>
    <h3 class="bg-success">
        <?php displayMessage(); ?>
    </h3>

    <a href="index.php?add_user" class="btn btn-default">Add User</a>
    <br>
    <br>

    <div class="col-md-12">

        <table class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            displayUsersAdmin();
            deleteUserAdmin();
            ?>
            </tbody>
        </table> <!--End of Table-->


    </div>


</div>
    


