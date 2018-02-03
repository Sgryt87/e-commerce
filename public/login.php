<?php
require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");

if (isset($_POST['login'])) {
    $username = cleanData($_POST['username']);
    $user_password = cleanData($_POST['user_password']);

    $query = query("SELECT * FROM users where username = '{$username}'");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }

    if (password_verify($user_password, $db_user_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        if($_SESSION['user_role'] === 'admin') {
            redirect('admin');
        } else {
            redirect('index.php');
        }

    }
}

?>

    <!-- Page Content -->
    <div class="container">
        <header>
            <h1 class="text-center">Login</h1>
            <h2 class="text-center bg-warning"></h2>
            <div class="col-sm-6 col-sm-offset-3">
                <form class="" action="" method="post" enctype="multipart/form-data">

                    <?php //echo $logged; ?>
                    <div class="form-group">
                        <label for="username">
                            Username</label><input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">
                            Password</label><input type="password" name="user_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary form-control">
                    </div>
                </form>
            </div>


        </header>


    </div>

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>