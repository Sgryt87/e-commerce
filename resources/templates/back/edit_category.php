<?php
editCategoryAdmin();
?>
<div class="row">
    <div class="col-md-6">

        <form action="" method="post">

            <div class="form-group">
                <?php displayCategoryToEditAdmin(); ?>
            </div>

            <div class="form-group">
                <input name="edit_category" type="submit" class="btn btn-primary" value="Update Category">
            </div>

        </form>

    </div>
</div>
