<?php
require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");

if (isset($_POST['login'])) {
    $username = cleanData($_POST['username']);
    $user_password = cleanData($_POST['username']);

    $query = query("SELECT * FROM users where username = '{$username}'");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }

    if (password_verify($user_password, $db_user_password)) {
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        redirect('../admin/index.php');
    } else {
        redirect('index.php');
    }
}

?>

    <!-- Page Content -->
    <div class="container">
        <?php echo $_SESSION['username'] = $db_username;
        echo $_SESSION['user_role'] = $db_user_role; ?>
        <header>
            <h1 class="text-center">Login</h1>
            <h2 class="text-center bg-warning"></h2>
            <div class="col-sm-4 col-sm-offset-5">
                <form class="" action="" method="post" enctype="multipart/form-data">


                    <div class="form-group"><label for="">
                            username<input type="text" name="username" class="form-control"></label>
                    </div>
                    <div class="form-group"><label for="password">
                            Password<input type="password" name="user_password" class="form-control"></label>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="login" class="btn btn-primary">
                    </div>
                </form>
            </div>


        </header>


    </div>

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>