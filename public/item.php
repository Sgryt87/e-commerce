<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>
    <!-- Page Content -->
    <div class="container">

        <!-- Side Navigation -->

        <?php include(TEMPLATE_FRONT . DS . "side_nav.php");
        if (isset($_GET['id'])) {
            $get_product_id = cleanData($_GET['id']);
            $query = query("SELECT * FROM products WHERE product_id = {$get_product_id}");
            confirmQuery($query);
            while ($row = fetchQuery($query)):
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_price = $row['product_price'];
                //$product_category_id = $row['product_category_id'];
                $product_description = $row['product_description'];
                $product_image = $row['product_image'];

                ?>

                <div class="col-md-9">

                    <!--Row For Image and Short Description-->

                    <div class="row">

                        <div class="col-md-7">


                            <img class="img-responsive" src="../resources/uploads/<?php echo $product_image; ?>"
                                 alt="<?php echo $product_title ?>">


                        </div>

                        <div class="col-md-5">

                            <div class="thumbnail">


                                <div class="caption-full">
                                    <h4><?php echo $product_title ?></h4>
                                    <hr>
                                    <h4 class="">&#36;<?php echo $product_price; ?></h4>

                                    <div class="ratings">
                                        <p>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                            4.0 stars
                                        </p>
                                    </div>
                                    <p>
                                        <?php
                                        if (strlen(substr($product_description, 0, 100)) <= 100) {
                                            echo substr($product_description, 0, 100) . '...';
                                        } else {
                                            echo substr($product_description, 0, 100);
                                        }
                                        ?>
                                    </p>

                                    <form action="">
                                        <div class="form-group">
                                            <a href="../resources/cart.php?add=<?php echo $product_id ?>"
                                               class="btn btn-primary">Add</a>
                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>


                    </div><!--Row For Image and Short Description-->


                    <hr>


                    <!--Row for Tab Panel-->

                    <div class="row">

                        <div role="tabpanel">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#description"
                                                                          aria-controls="description"
                                                                          role="tab"
                                                                          data-toggle="tab">Description</a></li>
                                <li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab"
                                                           data-toggle="tab">Reviews</a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="description">
                                    <p></p>
                                    <p><?php echo $product_description; ?></p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="reviews">

                                    <div class="col-md-6">

                                        <h3>2 Reviews From </h3>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                Anonymous
                                                <span class="pull-right">10 days ago</span>
                                                <p>This product was great in terms of quality. I would definitely buy
                                                    another!</p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                Anonymous
                                                <span class="pull-right">12 days ago</span>
                                                <p>I've alredy ordered another one!</p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                Anonymous
                                                <span class="pull-right">15 days ago</span>
                                                <p>I've seen some better than this, but not at this price. I definitely
                                                    recommend this item.</p>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <h3>Add A review</h3>

                                        <form action="" class="form-inline">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="test" class="form-control">
                                            </div>

                                            <div>
                                                <h3>Your Rating</h3>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                                <span class="glyphicon glyphicon-star"></span>
                                            </div>

                                            <br>

                                            <div class="form-group">
                                                <textarea name="" id="" cols="60" rows="10"
                                                          class="form-control"></textarea>
                                            </div>

                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary" value="SUBMIT">
                                            </div>
                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>


                    </div><!--Row for Tab Panel-->


                </div><!-- col-md-9 ends here -->
            <?php endwhile;
        } else {
            redirect('index.php');
        } ?>

    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>