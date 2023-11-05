<?php

namespace app\views\comments;
error_reporting(E_ERROR | E_PARSE);
class NewComment
{
    public function show($postID): string
    {
        $pfp = $_SESSION['profile_picture'];
        if (!file_exists($pfp)) {
            $pfp = 'profiles/default/default.png';
        }
        ob_start();
?>
<div class="comment-form">
    <form method="POST" action="">
        <div class="post-pfp">
            <img src="/<?= $pfp ?>" alt="Profile Picture">
        </div>
        <input type="hidden" name="post_id" value="<?= $postID ?>">
        <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
        <textarea name="text" placeholder="Write a comment..."></textarea>
        <div class="buttons">
            <button class="btn btn-primary" type="submit" name="comment">Comment</button>
        </div>
    </form>
</div>
<?php
        return ob_get_clean();
    }
}
?>
