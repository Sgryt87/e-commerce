<?php

function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

function fetchQuery($sql)
{
    return mysqli_fetch_array($sql);
}

function confirmQuery($conn)
{
    global $connection;
    if (!$conn) {
        die('Query Failed ' . mysqli_error($connection));
    }
}

function cleanData($data)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim(htmlentities($data)));
}

function redirect($location)
{
    header("Location: $location");
}

//FRONT
//get products

function getProducts()
{
    $query = query("SELECT * FROM products");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        //$product_category_id = $row['product_category_id'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image'];

        $product = <<<DELIMITER

        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <a href="item.php?id={$product_id}"><img src="{$product_image}" alt=""></a>
                <div class="caption">
                    <h4 class="pull-right">&#36;{$product_price}</h4>
                    <h4><a href="item.php?id={$product_id}">{$product_title}</a></h4>
                    <p>{$product_description}<a href="" target="_blank"></a></p>
                    <a href="../resources/cart.php?add={$product_id}" class="btn btn-primary" target="_blank">Add To Cart</a>
                </div>
            </div>
        </div>

DELIMITER;

        echo $product;

    }
}

function getCategories()
{
    $query = query("SELECT * FROM categories");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        $categories = <<<DELIMITER
     
        <a href="category.php?id={$cat_id}" class="list-group-item">{$cat_title}</a>
DELIMITER;

        echo $categories;
    }
}

function getProductsInCategoryPage()
{
    if (isset($_GET['id'])) {
        $get_category_id = cleanData($_GET['id']);
        $query = query("SELECT * FROM products WHERE product_category_id = {$get_category_id}");
        confirmQuery($query);
        while ($row = fetchQuery($query)):
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_price = $row['product_price'];
            $product_category_id = $row['product_category_id'];
            $product_description = $row['product_description'];
            $product_image = $row['product_image'];
            $products = <<<DELIMETER

        <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$product_title}</h3>
                        <p>{$product_description}</p>
                        <p><a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$product_id}" 
                        class="btn 
                        btn-default">More 
                        Info</a></p>
                    </div>
                </div>
            </div>
DELIMETER;
            echo $products;
        endwhile;
    } else {
        redirect('index.php');
    }
}

function getProductsInShopPage()
{
    $query = query("SELECT * FROM products");
    confirmQuery($query);
    while ($row = fetchQuery($query)):
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $product_category_id = $row['product_category_id'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image'];
        $products = <<<DELIMETER

        <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$product_title}</h3>
                        <p>{$product_description}</p>
                        <p><a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$product_id}" 
                        class="btn btn-default">More Info</a></p>
                    </div>
                </div>
            </div>
DELIMETER;
        echo $products;
    endwhile;
}

function isNameExists($username)
{
    $query = query("SELECT username FROM users WHERE username = '{$username}'");
    confirmQuery($query);
    return (mysqli_num_rows($query) > 0 ? true : false);
}

function isEmailExists($email)
{
    $query = query("SELECT user_email FROM users WHERE user_email = '{$email}'");
    confirmQuery($query);
    return (mysqli_num_rows($query) > 0 ? true : false);
}

//BACK

function setMessage($message)
{
    if (!empty($message)) {
        $_SESSION['message'] = $message;
    }
}

function displayMessage()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function displayOrders()
{
    deleteOrdersAdmin();

    $query = query("SELECT * FROM orders");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $order_id = $row['order_id'];
        $order_amount = $row['order_amount'];
        $order_transaction = $row['order_transaction'];
        $order_currency = $row['order_currency'];
        $order_status = $row['order_status'];

        $orders = <<<ORDERS

<tr>
<td>{$order_id}</td>
<td>{$order_amount}</td>
<td>{$order_transaction}</td>
<td>{$order_currency}</td>
<td>{$order_status}</td>
<td><form action="" method="post">
<input type="hidden" name="id" value="$order_id">
<input type="submit" value="X" name="delete" class="btn btn-danger btn-sm">
</form></td>
</tr>
ORDERS;
        echo $orders;
    }
}

function deleteOrdersAdmin()
{
    if (isset($_POST['delete'])) {
        $post_order_id = cleanData($_POST['id']);
        $delete_query = query("DELETE FROM orders WHERE order_id = $post_order_id");
        confirmQuery($delete_query);
        setMessage('Order deleted');
        redirect('index.php?orders');
    }
}

function displayProductsAdmin()
{
    $query = query("SELECT * FROM products");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_category = $row['product_category_id'];
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $product_image = $row['product_image'];

        $products = <<<PRODUCTS

<tr>
<td>{$product_id}</td>
<td>{$product_title}
<br>
<a href=""><img src="{$product_image}" alt="{$product_title}" width="150px"></a> 
</td>
<td>{$product_category}</td>
<td>&#36;{$product_price}</td>
<td>{$product_quantity}</td>
<td><a href="" class="btn btn-warning">Edit</a></td>
<td>
    <form action="" method="post">
    <input type="hidden" name="id" value="$product_id">
    <input type="submit" value="Delete" name="delete" class="btn btn-danger btn-sm">
    </form>
</td>
</tr>

PRODUCTS;
        echo $products;
    }
}

function deleteProductsAdmin()
{
    if (isset($_POST['delete'])) {
        $post_product_id = cleanData($_POST['id']);
        $delete_query = query("DELETE FROM products WHERE product_id = $post_product_id");
        confirmQuery($delete_query);
        setMessage('Product deleted');
        redirect('index.php?products');
    }
}

function addProductAdmin()
{
    $numberErr = '';
    if (isset($_POST[''])) {
        $product_title = cleanData($_POST['product_title']);
        $product_description = cleanData($_POST['product_description']);
        $product_category_id = cleanData($_POST['product_category_id']);
        $product_quantity = cleanData($_POST['product_quantity']);
        $product_price = cleanData($_POST['product_price']);
        $product_image = cleanData($_POST['product_image']);
    }
}