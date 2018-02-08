<?php
if (isset($_GET['id'])) {
    $get_id = cleanData($_GET['id']);
    $query = query("SELECT * FROM users WHERE user_id = $get_id");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
    }
} else {
    redirect('index.php?users');
}
?>


<h1 class="page-header">
    Edit User
    <small><?php echo $user_firstname . ' ' . $user_lastname; ?></small>
</h1>

<div class="col-md-5 user_image_box">

    <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="" alt="<?php echo $user_image;?> "></a>

</div>


<form action="" method="post" enctype="multipart/form-data">


    <div class="col-md-7">

        <div class="form-group">

            <input type="file" name="file">

        </div>


        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username;?>">

        </div>


        <div class="form-group">
            <label for="first name">First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?php echo $user_firstname;?>">

        </div>

        <div class="form-group">
            <label for="last name">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?php echo $user_lastname;?>">

        </div>


        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Please Enter Password">

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Please Confirm Password">

        </div>

        <div class="form-group">

<!--            <a id="user-id" class="btn btn-danger" href="">Delete</a>-->

            <input type="submit" name="update_user" class="btn btn-primary btn-block" value="Update">

        </div>


    </div>


</form>





    