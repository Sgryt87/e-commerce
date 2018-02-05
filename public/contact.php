<?php
require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");

$nameErr = '';
$subjectErr = '';
$emailErr = '';
$messageErr = '';

if (isset($_POST['send'])) {


    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    //name
    if (empty($name)) {
        $nameErr = "Name Is Required";
    } else if (strlen($name) < 2) {
        $nameErr = "Your Name Must Contain At Least 2 Characters";
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only Letters And White Space Allowed";
    }

    //subject
    if (!preg_match("/^[a-zA-Z ]*$/", $subject)) {
        $subjectErr = "Only Letters And White Space Allowed";
    }

    //email
    if (empty($email)) {
        $emailErr = "Email Is Required";
    } else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
        $emailErr = "Invalid Email";
    }
    //message
    if (empty($message)) {
        $messageErr = "Message Cannot Be Empty";
    } else if (strlen($message) < 5) {
        $messageErr = 'Message Must Contain At Least 5 Characters';
    }

    if ($nameErr === '' &&
        $subjectErr === '' &&
        $emailErr === '' &&
        $messageErr === '') {

        $toEmail = 'example@email.com';
        $headers = "From: {$name} {$email}";
        $result = mail($toEmail, $subject, $message, $headers);
        if ($result) {
            setMessage('Email was sent successfully');
        } else {
            setMessage('Something Went Wrong, Email Wasn\'t Sent...');
            redirect('contact.php');
        }
    }
}
?>

    <!-- Contact Section -->

    <div class="container">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <h1>Contact Us</h1>
                            <br>
                            <h5 class="text-center text-info bg-info center-block"><?php displayMessage(); ?></h5>
                            <form role="form" action="contact.php" method="post" id="login-form"
                                  autocomplete="off">
                                <div class="form-group">
                                    <h6 class="text-info">Your Name</h6>
                                    <label for="username" class="sr-only">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           placeholder="Please Enter Your Username">
                                    <h5 class="text-center text-danger"><?php echo $nameErr; ?></h5>
                                </div>
                                <div class="form-group">
                                    <h6 class="text-info">Email</h6>
                                    <label for="user_email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           placeholder="Please Enter Your Email">
                                    <h5 class="text-center text-danger"><?php echo $emailErr; ?></h5>
                                </div>
                                <div class="form-group">
                                    <h6 class="text-info">Subject</h6>
                                    <label for="username" class="sr-only">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control"
                                           placeholder="Please Enter Your Username">
                                    <h5 class="text-center text-danger"><?php echo $subjectErr; ?></h5>
                                </div>
                                <div class="form-group">
                                    <h6 class="text-info">Message</h6>
                                    <label for="user_firstname" class="sr-only">Message</label>
                                    <textarea name="message" id="" cols="30" rows="10" class="form-control"
                                              maxlength="1000"></textarea>
                                    <h5 class="text-center text-danger"><?php echo $messageErr; ?></h5>
                                </div>
                                <input type="submit" name="send" id="btn-login"
                                       class="btn btn-default btn-lg btn-block"
                                       value="Send Email" style="margin-bottom: 50px;">
                            </form>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
    </div>

    </div>
    <!-- /.container -->


<?php include(TEMPLATE_FRONT . DS . "header.php") ?>