<?php

namespace app\views\posts;

use app\views\layouts\Layout;
use app\views\partials\Navbar;
use app\views\posts\NewPost;
use app\views\posts\Post;

class FullPost
{
public function show($post): void
{
ob_start();
echo (new NewPost())->show();
?>
<div class="category-feed">

</div>

<div class="feed">
<?= (new Post())->show($post); ?>
</div>

<div class="navbar-feed">
    <?= (new Navbar())->show() ?>
</div>
<?php
    (new Layout('PasX - Post', ob_get_clean(), 'home'))->show();
}
}
?>
