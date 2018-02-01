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
    header('Location: $link');
}

//get products

function getProducts()
{
    $query = query("SELECT * FROM products");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $product_category_id = $row['product_category_id'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image'];

        $product = <<<DELIMETER

        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <img src="{$product_image}" alt="">
                <div class="caption">
                    <h4 class="pull-right">&#36;{$product_price}</h4>
                    <h4><a href="">{$product_title}</a></h4>
                    <p>{$product_description}<a href="" target="_blank"></a></p>
                    <a href="item.php?id={$product_id}" class="btn btn-primary" target="_blank">Add To Cart</a>
                </div>
            </div>
        </div>

DELIMETER;
        echo $product;

    }
}

