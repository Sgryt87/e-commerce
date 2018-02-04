<?php
require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");

//$message = '';
$messageErr = '';
$usernameErr = '';
$emailErr = '';
$firstNameErr = '';
$lastNameErr = '';
$passwordErr = '';
$confirm_passwordErr = '';


if (isset($_POST['submit'])) {

    $username = cleanData($_POST['username']);
    $user_password = cleanData($_POST['user_password']);
    $user_confirm_password = cleanData($_POST['user_confirm_password']);
    $user_firstname = cleanData($_POST['user_firstname']);
    $user_lastname = cleanData($_POST['user_lastname']);
    $user_email = cleanData($_POST['user_email']);


//username
    if (empty($username)) {
        $usernameErr = "Username Is Required";
    } else if (strlen($username) < 2) {
        $usernameErr = "Your Username Must Contain At Least 2 Characters";
    } else {
        if (isNameExists($username)) {
            $usernameErr = 'This Username Already Exists';
        } else if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
            $usernameErr = "Only Letters And White Space Allowed";
        }
    }

//useremail
    if (empty($user_email)) {
        $emailErr = "Email Is Required";
    } else {
        if (isEmailExists($user_email)) {
            $emailErr = 'This Email Already Exists';
        } else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $user_email)) {
            $emailErr = "Invalid Email";
        }
    }

//first_name
    if (empty($user_firstname)) {
        $firstNameErr = 'First Name Is Required';
    } else if (!preg_match("/^[a-zA-Z ]*$/", $user_firstname)) {
        $firstNameErr = 'Only Letters And White Space Allowed';
    }

//last_name
    if (empty($user_lastname)) {
        $lastNameErr = 'Last Name Is Required';
    } else if (!preg_match("/^[a-zA-Z ]*$/", $user_lastname)) {
        $lastNameErr = 'Only Letters And White Space Allowed';
    }
//password
    if (empty($user_password)) {
        $passwordErr = 'Password Is Required';
        if (empty($user_confirm_password)) {
            $confirm_passwordErr = 'You Have To Confirm Your Password';
        }
    } else {
        if ($user_password !== $user_confirm_password) {
            $confirm_passwordErr = 'Password Doesn\'t Match';
        } else if (strlen($user_password) <= 2) { // has to be 8 digits
            $passwordErr = 'Your Password Must Contain At Least 8 Characters';
        }
//        elseif (!preg_match("#[0-9]+#", $user_password)) {
//            $passwordErr = "Your Password Must Contain At Least 1 Number!";
//        } elseif (!preg_match("#[A-Z]+#", $user_password)) {
//            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
//        }
    }

    if (
        $usernameErr === '' &&
        $emailErr === '' &&
        $firstNameErr === '' &&
        $lastNameErr === '' &&
        $passwordErr === '' &&
        $confirm_passwordErr === '') {


        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' > 12));
        $query = query("INSERT INTO users 
                                    (username,
                                    user_email,
                                    user_password,
                                    user_firstname,
                                    user_lastname,
                                    user_role) 
                              VALUES 
                                    ('{$username}',
                                    '{$user_email}',
                                    '{$user_password}',
                                    '{$user_firstname}',
                                    '{$user_lastname}',
                                    'subscriber'
                                    )");
        confirmQuery($query);
        setMessage('Congratulations, You Have Been Registered!');
    }
} // end if


?>
<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Registration</h1>
                        <h6 class="text-info">* - required fields</h6>
                        <br>
                        <h5 class="text-center text-success bg-success center-block"><?php displayMessage(); ?></h5>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <h6 class="text-info">*Username (Your Username Must Contain At Least 3 Characters)</h6>
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Please Enter Your Username">
                                <h5 class="text-center text-danger"><?php echo $usernameErr; ?></h5>
                            </div>
                            <div class="form-group">
                                <h6 class="text-info">*Email</h6>
                                <label for="user_email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="email" class="form-control"
                                       placeholder="Please Enter Your Email">
                                <h5 class="text-center text-danger"><?php echo $emailErr; ?></h5>
                            </div>
                            <div class="form-group">
                                <h6 class="text-info">*First Name</h6>
                                <label for="user_firstname" class="sr-only">First Name</label>
                                <input type="text" name="user_firstname" id="first_name" class="form-control"
                                       placeholder="Please Enter Your First Name">
                                <h5 class="text-center text-danger"><?php echo $firstNameErr; ?></h5>
                            </div>
                            <div class="form-group">
                                <h6 class="text-info">*Last Name</h6>
                                <label for="user_lastname" class="sr-only">Last Name</label>
                                <input type="text" name="user_lastname" id="last_name" class="form-control"
                                       placeholder="Please Enter Your Last Name">
                                <h5 class="text-center text-danger"><?php echo $lastNameErr;; ?></h5>
                            </div>
                            <div class="form-group">
                                <h6 class="text-info">*Password (Password Must Contain At Least 8 Characters, One
                                    Capital Letter And
                                    One
                                    Number)</h6>
                                <label for="user_password" class="sr-only">Password</label>
                                <input type="password" name="user_password" id="key" class="form-control"
                                       placeholder="Please enter Your Password">
                                <h5 class="text-center text-danger"><?php echo $passwordErr; ?></h5>
                            </div>
                            <div class="form-group">
                                <h6 class="text-info">*Confirm Password</h6>
                                <label for="user_confirm_password" class="sr-only form-group">Confirm Password</label>
                                <input type="password" name="user_confirm_password" id="con_key" class="form-control"
                                       placeholder="Confirm Your Password">
                                <h5 class="text-center text-danger">
                                    <h5 class="text-center text-danger"><?php echo $confirm_passwordErr; ?></h5>
                            </div>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-default btn-lg btn-block"
                                   value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
