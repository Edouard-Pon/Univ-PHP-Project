<?php

namespace app\views\posts;

class NewComment
{
    public function show(): string
    {
        ob_start();
        ?>
        <div id="newCommentForm">
            <form method="POST" action="">
                <textarea name="text" placeholder="Write a comment..."></textarea>
                <div class="buttons">
                    <button class="btn btn-primary" type="submit" name="post">Post</button>
                </div>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}
?>
}