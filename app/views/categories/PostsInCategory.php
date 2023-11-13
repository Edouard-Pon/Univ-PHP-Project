<?php

namespace app\views\categories;
error_reporting(E_ERROR | E_PARSE);
use app\views\layouts\Layout;
use app\views\partials\Navbar;
use app\views\posts\NewPost;
use app\views\posts\Post as Post;

class PostsInCategory
{
    public function show($postsincategory,$allcategories,$categoriesNames,$selectedCategory): void
    {
        ob_start();
        ?>
        <div class="category-feed">

            <?php if (!empty($selectedCategory))
                echo (new Category())->show($categoriesNames); ?>
            <?php if (isset($_SESSION['errorMessage'])) { ?>
                <p id="errorMessage"> <?= $_SESSION['errorMessage'] ?></p>
                <?php unset($_SESSION['errorMessage']); } ?>
        </div>
        <div class="feed">
            <button class="btn btn-primary btn-navbar-phone" onclick="showNavBar()">Navigation</button>
            <?php
            echo (new NewPost())->show($categoriesNames);
            if (!empty($selectedCategory)){
                echo "<h1>#".$selectedCategory.'</h1>';
            }else {
                echo '<h1>Page des catégories</h1>';
                echo (new Category())->show($categoriesNames);
            }
            foreach ($postsincategory as $post) {
                echo (new Post())->show($post, $allcategories);
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