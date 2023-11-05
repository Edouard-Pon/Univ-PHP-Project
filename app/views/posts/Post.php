<?php

namespace app\views\posts;

class Post
{
    public function show($post, $categories): string
    {
        $category = null;
        if (is_array($categories)) {
            foreach ($categories as $categoryData) {
                if ($categoryData['post_id'] === $post['id']) {
                    $category = $categoryData['category_name'];
                    break;
                }
            }
        } else {
            $category = $categories;
        }

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
    <a class="close" href="/profile/<?= $post['post_author'] ?>/post/<?= $post['id'] ?>"></a>
    <div class="post-top">
        <div class="user-info">
            <div class="post-pfp">
                <img src="/<?= $pfp ?>" alt="Profile picture">
            </div>
            <a href="/profile/<?= $post['post_author'] ?>">@<?= $post['post_author'] ?></a>
        </div>

        <?php if ($post['post_author'] === $_SESSION['username'] || isset($_SESSION['admin']) && $_SESSION['admin']) { ?>
        <button class="btn btn-danger" onclick="location.href = '/profile/<?= $post['post_author'] ?>/post/<?= $post['id'] ?>/delete'" type="submit">Delete</button>
        <?php } ?>
    </div>
    <?php if (!empty($post['post_title'])) { ?>
    <h2 class="title"><?= $post['post_title'] ?></h2>
    <?php } ?>
    <?php if (!empty($post['post_text'])) { ?>
    <p class="text"><?= $post['post_text'] ?></p>
    <?php } ?>
    <?php if ($image) { ?>
        <div class="image-container <?= $vertical ? 'vertical' : 'horizontal' ?>">
            <img src="/<?= $post['post_path'] ?>" alt="Image">
        </div>
    <?php } ?>
    <div class="post-footer">
        <time datetime="<?= $post['post_date'] ?>"><?= date("H:i d.m.Y", strtotime($post['post_date'])) ?></time>
        <span>Comments: <?= $post['comments_count'] ?></span>
        <?php if ($category !== null) { ?>
        <span>#<?= $category ?></span>
        <?php } ?>
    </div>
</div>
<?php
        return ob_get_clean();
    }
}
?>

