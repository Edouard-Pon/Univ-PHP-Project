<?php

namespace app\views\posts;

class NewPost
{
    public function show(): string
    {
        ob_start();
?>
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
    </form>
</div>
<?php
        return ob_get_clean();
    }
}
?>

