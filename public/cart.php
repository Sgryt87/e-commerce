<?php
require_once '../resources/config.php';
if (isset($_GET['add'])) {
    $get_id = cleanData($_GET['add']);
    $query = query("SELECT * FROM products WHERE product_id = $get_id");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $product_name = $row['product_title'];
        $product_quantity = $row['product_quantity'];
        if ($product_quantity > ($_SESSION["product_" . $_GET['add']])) {
            $_SESSION["product_" . $_GET['add']] += 1;
            redirect('checkout.php');
        } else {
            setMessage("We are sorry for the inconvenience, but there are only " . $product_quantity . " " .
                $product_name . "(s) available at this moment.");
            redirect('checkout.php');
        }
    }
}


if (isset($_GET['remove'])) { // if below 0??
    if ($_SESSION["product_" . $_GET['remove']] > 0) {
        $_SESSION["product_" . $_GET['remove']]--;
        redirect('checkout.php');
        if ($_SESSION["product_" . $_GET['remove']] < 1) {
            redirect('checkout.php');
        }
    } else {
        redirect('checkout.php');
    }
}

if (isset($_GET['delete'])) {
    $_SESSION["product_" . $_GET['delete']] = 0;
    redirect('checkout.php');
}

function cart()
{
    $query = query("SELECT * FROM products");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $product_category_id = $row['product_category_id'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image'];
        $subtotal = $_SESSION['product_1'] * $product_price;
        $products = <<<PRODUCTS
        
                  <tr>
                    <td>{$product_title}</td>
                    <td>{$product_price}</td>
                    <td>{$product_quantity}</td>
                    <td><span class="amount">&#36;</span>{$subtotal}</td>
                    <td class="text-center">
                        <a href="cart.php?remove=1" class="btn btn-warning btn-sm">-</a>
                        <a href="cart.php?add=1" class="btn btn-success btn-sm">+</a>
                        <a href="cart.php?delete=1" class="btn btn-danger btn-sm">X</a>
                    </td>
                  </tr>

PRODUCTS;

        echo $products;

    }
}

