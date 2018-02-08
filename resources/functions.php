<?php

function lastId()
{
    global $connection;
    return mysqli_insert_id($connection);
}

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
    $query = query("SELECT * FROM products WHERE product_quantity > 0");
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
                <a href="item.php?id={$product_id}"><img src="../resources/uploads/{$product_image}" alt=""></a>
                <div class="caption">
                    <h4 class="pull-right">&#36;{$product_price}</h4>
                    <h4><a href="item.php?id={$product_id}">{$product_title}</a></h4>
                    <p>{$product_description}<a href="item.php?id={$product_id}" target="_blank"></a></p>
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
                    <a href="item.php?id={$product_id}"><img src="../resources/uploads/{$product_image}" alt="$product_title"></a>
                    <div class="caption">
                        <h3>{$product_title}</h3>
                        <p>{$product_description}</p>
                        <p><a href="../resources/cart.php?add={$product_id}" class="btn btn-primary">Buy Now!</a> <a 
                        href="item.php?id={$product_id}" 
                        class="btn 
                        btn-default">More 
                        Info</a></p>
                    </div>
                </div>
            </div>
DELIMETER;
        echo $products;
    endwhile;
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
                    <img src="../resources/uploads/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$product_title}</h3>
                        <p>{$product_description}</p>
                        <p><a href="../resources/cart.php?add={$product_id}" class="btn btn-primary">Buy Now!</a> <a 
                        href="item.php?id={$product_id}" 
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

//ORDERS

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

//REPORTS

function displayReportsAdmin()
{
    $query = query("SELECT * FROM reports");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $report_id = $row['report_id'];
        $product_id = $row['product_id'];
        $order_id = $row['order_id'];
        $product_price = $row['product_price'];
        $product_title = $row['product_title'];
        $product_quantity = $row['product_quantity'];

        $reports = <<<REPORTS

           <tr> 
           <td>$report_id</td>
           <td>$product_id</td>
           <td>$order_id</td>
           <td>$product_price</td>
           <td>$product_title</td>
           <td>$product_quantity</td>
           <td> 
            <form action="" method="post">
            <input type="hidden" name="id" value="$report_id">
            <input type="submit" value="X" name="delete" class="btn btn-danger btn-sm">
            </form>
           </td>
           </tr>

REPORTS;
        echo $reports;

    }
}

function deleteReportsAdmin()
{
    if (isset($_POST['delete'])) {
        $post_report_id = cleanData($_POST['id']);
        $delete_query = query("DELETE FROM reports WHERE report_id = $post_report_id");
        confirmQuery($delete_query);

        setMessage('Report Was Deleted');
        redirect('index.php?reports');
    }
}

//PRODUCTS

function displayProductsAdmin()
{
    $query = query("SELECT * FROM products");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_category_id = $row['product_category_id'];
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $product_image = $row['product_image'];

        $product_category = displayProductCategoryAdmin($product_category_id);


        $products = <<<PRODUCTS

<tr>
<td>{$product_id}</td>
<td>{$product_title}
<br>
<a href="index.php?edit_product&id={$product_id}"><img src="../../resources/uploads/{$product_image}" 
alt="{$product_title}" width="250px"></a> 
</td>
<td>{$product_category}</td>
<td>&#36;{$product_price}</td>
<td>{$product_quantity}</td>
<td><a href="index.php?edit_product&id={$product_id}" class="btn btn-primary">Edit</a></td>
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

function displayProductCategoryAdmin($id)
{
    $query = query("SELECT cat_title FROM categories WHERE cat_id = $id");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        return $row['cat_title'];
    }
}

function displayProductToEditAdmin()
{
//
}

function editProductAdmin()
{
    if (isset($_POST['publish'])) {
        $product_id = cleanData($_POST['product_id']);
        $product_title = cleanData($_POST['product_title']);
        $product_description = cleanData($_POST['product_description']);
        $product_category_id = cleanData($_POST['product_category_id']);
        $product_quantity = cleanData($_POST['product_quantity']);
        $product_price = cleanData($_POST['product_price']);

        $product_image = cleanData($_FILES['file']['name']);
        $product_image_temp = cleanData($_FILES['file']['tmp_name']);

        if (empty($product_image)) {
            $get_image = query("SELECT product_image FROM products WHERE product_id = $product_id");
            confirmQuery($get_image);
            while ($row = fetchQuery($get_image)) {
                $product_image = $row['product_image'];
            }

        } else {

            unlink(UPLOAD_IMAGES . DS . $product_image);
        }
        move_uploaded_file($product_image_temp, UPLOAD_IMAGES . DS . $product_image);


        $query = query("UPDATE products SET product_title = '$product_title',
                                                 product_description = '$product_description',
                                                 product_category_id = '$product_category_id',
                                                 product_quantity ='$product_quantity',
                                                 product_price =  '$product_price',
                                                 product_image ='$product_image'
                                                 WHERE product_id = $product_id");


        confirmQuery($query);
        setMessage("Product Was Updated");
        redirect('index.php?products');
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
    $numberErr = '';  // cannot be negative
    if (isset($_POST['publish'])) {

        $product_title = cleanData($_POST['product_title']);
        $product_description = cleanData($_POST['product_description']);
        $product_category_id = cleanData($_POST['product_category_id']);
        $product_quantity = cleanData($_POST['product_quantity']);
        $product_price = cleanData($_POST['product_price']);

        $product_image = cleanData($_FILES['file']['name']);
        $product_image_temp = cleanData($_FILES['file']['tmp_name']);

        move_uploaded_file($product_image_temp, UPLOAD_IMAGES . DS . $product_image);


        $query = query("INSERT INTO products (product_title,
                                                  product_description,
                                                  product_category_id,
                                                  product_quantity,
                                                  product_price,
                                                  product_image) 
                                                    VALUES  ('$product_title',
                                                             '$product_description', 
                                                             '$product_category_id',
                                                             '$product_quantity',
                                                             '$product_price',
                                                             '$product_image')");
        $last_id = lastId();
        confirmQuery($query);
        setMessage("New Product id#{$last_id} Was Added");
        redirect('index.php?products');
    }
}

function displayCategoriesInProductsAdmin()
{
    $query = query("SELECT * FROM categories");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        $categories = <<<DELIMITER
        
         <option value="$cat_id">$cat_title</option>
DELIMITER;

        echo $categories;
    }
}

//CATEGORIES

function displayCategoriesAdmin()
{
    $query = query("SELECT * FROM categories");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        $categories = <<<DELIMITER
     
        <tr>
        <td>{$cat_id}</td>
        <td>{$cat_title}</td>
        <td> <a href="index.php?edit_category&id={$cat_id}" class="btn btn-primary">Edit</a></td>
        <td>
        <form action="" method="post">
            <input type="hidden" name="id" value="$cat_id">
            <input type="submit" value="Delete" name="delete" class="btn btn-danger btn-sm">
        </form>
        </td>
        </tr>
DELIMITER;

        echo $categories;
    }
}

function addCategoryAdmin()
{
    if (isset($_POST['add_category'])) {
        $cat_title = cleanData($_POST['cat_title']);
        $query = query("INSERT INTO categories (cat_title) VALUES('$cat_title')");
        confirmQuery($query);
        setMessage('Category Was Added');
        redirect('index.php?categories');
    }
}

function displayCategoryToEditAdmin()
{
    if (isset($_GET['id'])) {
        $cat_id = cleanData($_GET['id']);
        $query = query("SELECT * FROM categories WHERE cat_id = $cat_id");
        confirmQuery($query);
        while ($row = fetchQuery($query)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            $category = <<<CATEGORY
            <label for="category-cat_title">Rename</label>
            <input name="cat_title" type="text" class="form-control" value="$cat_title">
            <input type="hidden" name="cat_id" value="$cat_id">
      
CATEGORY;
            echo $category;
        }
    } else {
        redirect('index.php?categories');
    }
}

function editCategoryAdmin()
{
    if (isset($_POST['edit_category'])) {
        $cat_id = cleanData($_POST['cat_id']);
        $cat_title = cleanData($_POST['cat_title']);
        $query = query("UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $cat_id");
        confirmQuery($query);
        setMessage('Category Was Updated');
        redirect('index.php?categories');
    }
}

function deleteCategory()
{
    if (isset($_POST['delete'])) {
        $cat_id = cleanData($_POST['cat_id']);
        $query = query("DELETE FROM categories WHERE cat_id = $cat_id");
        confirmQuery($query);
        setMessage('Category Was Deleted');
        redirect('index.php?categories');
    }
}

//USERS

function displayUsersAdmin()
{
    $query = query("SELECT * FROM users");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $users = <<<USERS
     
        <tr>
        <td>{$user_id}</td>
        <td>{$username}</td>
        <td>{$user_email}</td>
        <td> <a href="index.php?edit_user&id={$user_id}" class="btn btn-primary">Edit</a></td>
        <td>
        <form action="" method="post">
            <input type="hidden" name="user_id" value="$user_id">
            <input type="submit" value="Delete" name="delete" class="btn btn-danger btn-sm">
        </form>
        </td>
        </tr>
USERS;

        echo $users;
    }
}

function deleteUserAdmin()
{
    if (isset($_POST['delete'])) {
       echo $user_id = cleanData($_POST['user_id']);
        $query = query("DELETE FROM users WHERE user_id = $user_id");
        confirmQuery($query);
        setMessage('User Was Deleted');
        redirect('index.php?users');
    }
}