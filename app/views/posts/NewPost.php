<?php

namespace app\views\posts;

class NewPost
{
    public function show(): string
    {
        ob_start();
?>
<div id="newPostForm">
    <h1>Create a new post</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title">
        <textarea name = "text" placeholder="Text"></textarea>
        <label class="postButton">
            <input type="file" name="image" required>
            Choose a picture
        </label>
        <div>
            <button class="postButton" type="reset" onclick="hideNewPostForm();">Cancel</button>
            <button class="postButton" type="submit" name="post">Upload</button>
        </div>
    </form>
</div>
<?php
        return ob_get_clean();
    }
}
?>

