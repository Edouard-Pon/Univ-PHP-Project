<?php

namespace app\views\comments;

class Comment
{
    public function show(array $comment, string $postAuthor): string
    {
        $pfp = 'profiles/' . $comment['comment_author'] . '/' . $comment['comment_author'] . '.jpg';
        if (!file_exists($pfp)) {
            $pfp = 'profiles/default/default.png';
        }
        ob_start();
?>
<div class="comment">
    <div class="post-top">
        <div class="user-info">
            <div class="post-pfp">
                <img src="/<?= $pfp ?>" alt="Profile picture">
            </div>
            <a href="/profile/<?= htmlspecialchars($comment['comment_author']) ?>">@<?= htmlspecialchars($comment['comment_author']) ?></a>
        </div>
        <?php if ($comment['comment_author'] === $_SESSION['username'] || isset($_SESSION['admin']) && $_SESSION['admin'] || $postAuthor === $_SESSION['username']) { ?>
            <button class="btn btn-danger" onclick="location.href = '/profile/<?= $comment['comment_author'] ?>/comment/<?= $comment['comment_id'] ?>/delete/<?= $comment['post_id'] ?>'" type="submit">Delete</button>
        <?php } ?>
    </div>
    <p class="comment-text">
    <?php
    $commentTextLines = explode("\n", $comment['comment_text']);
    foreach ($commentTextLines as $line) {
        echo $line . '<br>';
    }
    ?>
    </p>
</div>
<?php
        return ob_get_clean();
    }
}
