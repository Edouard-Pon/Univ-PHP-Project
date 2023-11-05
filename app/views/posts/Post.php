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
        $media = '';
        if (file_exists($post['post_path'])) {
            $fileExtension = pathinfo($post['post_path'], PATHINFO_EXTENSION);
            if ($fileExtension === 'mp4') {
                $media = '<video controls class="image-container">';
                $media .= '<source src="/' . $post['post_path'] . '" type="video/mp4">';
                $media .= '</video>';
            } elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $imageSize = getimagesize($post['post_path']);
                $vertical = ($imageSize !== false && $imageSize[1] > $imageSize[0]);
                $media = '<div class="image-container ' . ($vertical ? 'vertical' : 'horizontal') . '">';
                $media .= '<img src="/' . $post['post_path'] . '" alt="Media">';
                $media .= '</div>';
            }
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
                <a class="title" href="/profile/<?= $post['post_author'] ?>/post/<?= $post['id'] ?>"><?= htmlspecialchars($post['post_title']) ?></a>
            <?php } ?>
            <?php if (!empty($post['post_text'])) { ?>
                <p class="text"><?= htmlspecialchars($post['post_text']) ?></p>
            <?php } ?>
            <?= $media ?>
            <?php echo "Posted on: ".$post['post_date'];?>
        </div>
        <?php
        return ob_get_clean();
    }
}