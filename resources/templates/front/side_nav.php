<div class="col-md-3">
    <p class="lead">Shop Name</p>
    <div class="list-group">
        <?php
        $query = "SELECT * FROM categories";
        $categories = query($query);
        confirmQuery($categories);
        while ($row = fetchQuery($categories)) :
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            ?>
            <a href="" class="list-group-item"><?php echo $cat_title; ?></a>
        <?php endwhile; ?>
    </div>
</div>
