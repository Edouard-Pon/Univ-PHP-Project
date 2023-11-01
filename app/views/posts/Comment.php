<?php

namespace app\views\posts;

use app\views\Layout;

class Comment
{
    public function show($comments = null): string
    {
        ob_start();
        ?>
        <div class="comment-container">
            <div class="comments-dropdown">
                <button class="dropdown-button">Show Comments (METTRE NOMBRE DE COMMENTAIRES TOTAL ICI AVEC getCommentNbforPost</button>
                <div class="comments-list">
                    <?php foreach ($comments as $comment) { ?>
                        <?php $pfp = 'profiles/' . $comment['comment_author'] . '/' . $comment['comment_author'] . '.jpg';
                        if (!file_exists($pfp)) {
                            $pfp = 'profiles/default/default.png';
                        } ?>
                        <div class="comment">
                            <img class="comment-pfp" src="/<?= $pfp ?>" alt="Profile picture">
                            <p>Comment by: <a href="/profile/<?= htmlspecialchars($comment['comment_author']) ?>">@<?= htmlspecialchars($comment['comment_author']) ?></a>
                            <p><?= htmlspecialchars($comment['comment_text']) ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

