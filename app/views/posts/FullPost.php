<?php

namespace app\views\posts;
error_reporting(E_ERROR | E_PARSE);
use app\views\categories\Category;
use app\views\layouts\Layout;
use app\views\partials\Navbar;
use app\views\comments\Comment;
use app\views\comments\NewComment;

class FullPost
{
public function show($post, $comments, $category, $categoriesNames): void
{
ob_start();
echo (new NewPost())->show($categoriesNames);
?>
<div class="category-feed">
    <?php echo (new Category())->show($categoriesNames); ?>
</div>
<div class="feed">
<button class="btn btn-primary btn-navbar-phone" onclick="showNavBar()">Navigation</button>
<?= (new Post())->show($post, $category); ?>
<?= (new NewComment())->show($post['id']) ?>
<div class="comments-feed">
<?php
foreach ($comments as $comment) {
    echo (new Comment())->show($comment, $post['post_author']);
}
?>
</div>
</div>
<div class="navbar-feed" id="navBar">
    <?= (new Navbar())->show() ?>
</div>
<?php
    (new Layout('PasX - Post', ob_get_clean(), 'comments'))->show();
}
}
?>