<?php

namespace app\views\posts;

class Post
{
    public function show($post): string
    {
        $pfp = 'profiles/' . $post['post_author'] . '/' . $post['post_author'] . '.jpg';
        if (!file_exists($pfp)) {
            $pfp = 'profiles/default/default.png';
        }
        $image = false;
        if (file_exists($post['post_path'])) {
            $image = true;
            $imageSize = getimagesize($post['post_path']);
            $vertical = ($imageSize !== false && $imageSize[1] > $imageSize[0]);
        }
        ob_start();
?>
<div class="post-container">
    <div class="post-top">
        <div class="user-info">
            <div class="post-pfp">
                <img src="/<?= $pfp ?>" alt="Profile picture">
            </div>
            <a href="/profile/<?= htmlspecialchars($post['post_author']) ?>">@<?= htmlspecialchars($post['post_author']) ?></a>
        </div>

        <?php if ($post['post_author'] === $_SESSION['username'] || isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
        <button class="btn btn-danger" onclick="location.href = '/profile/<?= $post['post_author'] ?>/post/<?= $post['id'] ?>/delete'" type="submit">Delete</button>
        <?php } ?>
    </div>
    <?php if (!empty($post['post_title'])) { ?>
    <h2 class="title"><?= htmlspecialchars($post['post_title']) ?></h2>
    <?php } ?>
    <?php if (!empty($post['post_text'])) { ?>
    <p class="text"><?= htmlspecialchars($post['post_text']) ?></p>
    <?php } ?>
    <?php if ($image) { ?>
        <div class="image-container <?= $vertical ? 'vertical' : 'horizontal' ?>">
            <img src="/<?= $post['post_path'] ?>" alt="Image">
        </div>
    <?php } ?>
</div>
<?php
        return ob_get_clean();
    }
}
?>

