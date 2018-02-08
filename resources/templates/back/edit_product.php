<?php

if (isset($_GET['id'])) {
    $id = cleanData($_GET['id']);

    $query = query("SELECT * FROM products WHERE product_id = $id");
    confirmQuery($query);
    while ($row = fetchQuery($query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_category_id = $row['product_category_id'];
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image'];
        $product_category = displayProductCategoryAdmin($product_category_id);
    }
} else {
    redirect('index.php?products');
}
editProductAdmin();

?>


<div class="col-md-12">

    <div class="row">
        <h1 class="page-header">
            Edit Product
        </h1>
    </div>


    <form action="" method="post" enctype="multipart/form-data">


        <div class="col-md-8">

            <div class="form-group">
                <label for="product-title">Product Title </label>
                <input type="text" name="product_id" class="hidden" value="<?php echo $product_id; ?>">
                <input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>">
            </div>


            <div class="form-group">
                <label for="product-title">Product Description</label>
                <textarea name="product_description" id="" cols="30" rows="12"
                          class="form-control"><?php echo $product_description; ?></textarea>
            </div>


            <!--            <div class="form-group">-->
            <!--                <label for="product-title">Product Short Description</label>-->
            <!--                <textarea name="short_desc" id="" cols="30" rows="3" class="form-control"></textarea>-->
            <!--            </div>-->


        </div><!--Main Content-->


        <!-- SIDEBAR-->


        <aside id="admin_sidebar" class="col-md-4">


            <!-- Product Categories-->

            <div class="form-group">
                <label for="product-title">Product Category</label>

                <select name="product_category_id" id="" class="form-control">
                    <option value="<?php echo $product_category_id ?>"><?php echo $product_category; ?></option>
                    <?php displayCategoriesInProductsAdmin(); ?>
                </select>
            </div>


            <!-- Product Brands-->


            <div class="form-group">
                <label for="product-title">Product Quantity</label>
                <input type="number" name="product_quantity" class="form-control" min="0"
                       value="<?php echo $product_quantity; ?>">
                <h6 class="text-danger"><?php ?></h6>
            </div>

            <div class="form-group ">

                <label for="product-price">Product Price</label>
                <input type="number" name="product_price" class="form-control" size="60" step="any"
                       value="<?php echo $product_price; ?>">
                <h6 class="text-danger"><?php ?></h6>

            </div>


            <!-- Product Tags -->


            <!--  <div class="form-group">
                   <label for="product-title">Product Keywords</label>
                   <hr>
                 <input type="text" name="product_tags" class="form-control">
             </div>
          -->
            <!-- Product Image -->
            <div class="form-group">
                <img src="../../resources/uploads/<?php echo $product_image; ?>" alt="<?php echo $product_title ?>" width="294px;">
            </div>
            <div class="form-group">
                <label for="product-title">Product Image</label>
                <input type="file" name="file">
                <hr>
            </div>

            <div class="form-group">
                <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
                <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
            </div>


        </aside><!--SIDEBAR-->


    </form>
