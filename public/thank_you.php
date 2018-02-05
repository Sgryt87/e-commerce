<?php
require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");

if (isset($_GET['tx'])) {
    $amount = cleanData($_GET['amt']);
    $currency = cleanData($_GET['cc']);
    $transaction = cleanData($_GET['tx']);
    $status = cleanData($_GET['st']);

    $query = query("INSERT INTO orders(
                                            order_amount,
                                            order_transaction,
                                            order_status,
                                            order_currency) VALUES
                                            ($amount,
                                            '$transaction',
                                            '$status',
                                            '$currency')");
    confirmQuery($query);
} else {
    redirect('index.php');
}

?>


<!-- Page Content -->
<div class="container">

    <h1 class="text-center">Thank You for using us!</h1>


</div>
<!-- /.container -->


<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
