<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Home</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="shop.php">Shop</a>
            </li>
            <li>
                <a href="checkout.php">Checkout</a>
            </li>
            <li>
                <a href="contact.php">Contact</a>
            </li>
            <li>
                <a href="registration.php">Registration</a>
            </li>
            <li>
                <a href="admin">Admin</a>
            </li>
            <?php
            if (isset($_SESSION['user_role'])) {
                $displayName = <<<WELCOME
                
            <li><a href="">Welcome, {$_SESSION['user_firstname']}</a></li>
WELCOME;
                echo $displayName;
            } else {
                $displayLogin = <<<LOGIN
                
            <li>
                <a href="login.php">Login</a>
            </li>
LOGIN;
                echo $displayLogin;
            }
            ?>

            <li>
                <a href="logout.php">Logout</a>
            </li>
            <li>
                <a href="checkout.php"><i class="fa fa-fw fa-shopping-cart"></i><?php if (isset($_SESSION['item_quantity'])) {
                        echo ' ' . $_SESSION['item_quantity'];
                    } else {
                        echo '';
                    }
                    ?>
                </a>
            </li>
        </ul>


    </div>
    <!-- /.navbar-collapse -->
</div>
<!-- /.container -->