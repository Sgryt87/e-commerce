<h1 class="page-header">
    Product Categories

</h1>


<div class="col-md-4">

    <h3 class="bg-success"><?php displayMessage(); ?></h3>

    <form action="" method="post">

        <div class="form-group">
            <label for="category-title">Title</label>
            <input name="cat_title" type="text" class="form-control">
        </div>

        <div class="form-group">

            <input name="add_category" type="submit" class="btn btn-primary" value="Add Category">
        </div>


    </form>


</div>

<div class="col-md-8">

    <table class="table">
        <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <?php
        addCategoryAdmin();
        deleteCategory();
        displayCategoriesAdmin();
        ?>
        </tbody>

    </table>

</div>

