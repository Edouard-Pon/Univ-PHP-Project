<?php

namespace app\views\posts;
error_reporting(E_ERROR | E_PARSE);

class NewPost
{
    public function show($categories): string
    {
        ob_start();
?>
<a id="close-post-form" onclick="hideNewPostForm()"></a>
<div class="popup" id="newPostForm">
    <h1>Create a new post</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <input class="post-title" type="text" name="title" placeholder="Title">
        <label class="btn btn-primary uploadImgBtn" for="uploadImage">Upload Image</label>
        <input id="uploadImage" type="file" name="image">
        <textarea name="text" placeholder="Text"></textarea>
        <div class="buttons">
            <button class="btn btn-danger" type="reset" onclick="hideNewPostForm();">Cancel</button>
            <button class="btn btn-primary" type="submit" name="post">Post</button>
        </div>
        <label><br>Categories (optionnel)
        <select name="categories" id="categories">
            <option value="">Select a category</option>
            <option value="">None</option>
            <?php foreach ($categories as $category)
                echo "<option value=" . $category . ">" . $category . "</option>";
            if (isset($_SESSION['admin']) && $_SESSION['admin'])
                echo '<option value="new_category">Add new category</option>'
            ?>
        </select>
        </label>
        <div id="newCategoryInput" style="display: none;">
            <input type="text" name="custom_category" placeholder="New Category" id="custom_category">
        </div>
    </form>
</div>
<?php
        return ob_get_clean();
    }
}
?>

