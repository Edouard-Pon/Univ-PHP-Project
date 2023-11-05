<?php

namespace app\views\posts;

use app\views\categories\Category;
use app\views\layouts\Layout;
use app\views\partials\Navbar;
use app\views\comments\Comment;
use app\views\comments\NewComment;

class FullPost
{
public function show($post, $comments, $categories, $AllCategories): void
{
ob_start();
echo (new NewPost())->show($AllCategories);
?>
<div class="category-feed">
    <?php echo (new Category())->show($categories); ?>
</div>
<div class="feed">
<?= (new Post())->show($post); ?>
<?= (new NewComment())->show($post['id']) ?>
<div class="comments-feed">
<?php
foreach ($comments as $comment) {
    echo (new Comment())->show($comment, $post['post_author']);
}
?>
</div>
</div>

<div class="navbar-feed">
    <?= (new Navbar())->show() ?>
</div>
<?php
    (new Layout('PasX - Post', ob_get_clean(), 'comments'))->show();
}
}
?>