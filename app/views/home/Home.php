<?php

namespace app\views\home;
error_reporting(E_ERROR | E_PARSE);
use app\views\layouts\Layout;
use app\views\partials\Navbar;
use app\views\posts\NewPost;
use app\views\posts\Post;
use app\views\categories\Category;

class Home
{
    public function show($posts, $categories, $categoriesNames): void
    {
        ob_start();
        ?>
<div class="category-feed">
    <?php
    echo (new Category())->show($categoriesNames);
    if (isset($_SESSION['errorMessage'])) { ?>
    <p id="errorMessage"> <?= $_SESSION['errorMessage'] ?></p>
    <?php unset($_SESSION['errorMessage']); } ?>
</div>
<div class="feed">
<button class="btn btn-primary btn-navbar-phone" onclick="showNavBar()">Navigation</button>
<?php
echo (new NewPost())->show($categoriesNames);
foreach ($posts as $post) {
    echo (new Post())->show($post, $categories);
}
?>
</div>
<div class="navbar-feed" id="navBar">
    <?= (new Navbar())->show() ?>
</div>
<?php
        (new Layout('PasX - Home', ob_get_clean(), 'home'))->show();
    }
}

?>
