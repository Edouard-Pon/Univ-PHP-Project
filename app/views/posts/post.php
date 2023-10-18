<?php
if (file_exists($post['post_path'])) {
?>
<div class="post-container">
    <h2><?= htmlspecialchars($post['titre']) ?></h2>
    <p>Author: <?= htmlspecialchars($post['auteur']) ?></p>
    <p><?= htmlspecialchars($post['message']) ?></p>
    <div class="image-container">
        <img src="<?= $post['post_path'] ?>" alt="Image">
    </div>
</div>
<?php
}
?>
