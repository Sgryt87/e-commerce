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
    return mysqli_escape_string($connection, trim(htmlentities($data)));
}

function redirect($link)
{
    header("Location: $link");
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
                    <a href="item.php?id={$product_id}" class="btn btn-primary" target="_blank">Add To Cart</a>
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
                        <p><a href="#" class="btn btn-primary">Buy Now!</a><a href="item.php?id={$product_id}" 
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
                        <p><a href="#" class="btn btn-primary">Buy Now!</a><a href="item.php?id={$product_id}" 
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

//BACK
