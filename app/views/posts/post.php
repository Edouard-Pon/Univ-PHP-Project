<?php
$image = false;
if (file_exists($post['post_path'])) {
    $image = true;
    $imageSize = getimagesize($post['post_path']);
    $vertical = ($imageSize !== false && $imageSize[1] > $imageSize[0]);
}
?>
<div class="post-container">
    <div class="user-info">
        <div class="pfp">
            <img src="" alt="Profile picture">
        </div>
        <p>@<?= htmlspecialchars($post['post_author']) ?></p>
    </div>
    <h2 class="title"><?= htmlspecialchars($post['post_title']) ?></h2>
    <p class="text"><?= htmlspecialchars($post['post_text']) ?></p>
    <?php if ($image) { ?>
    <div class="image-container <?= $vertical ? 'vertical' : 'horizontal' ?>">
        <img src="<?= $post['post_path'] ?>" alt="Image">
    </div>
    <?php } ?>
</div>
