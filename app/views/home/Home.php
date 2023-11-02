<?php

namespace app\views\home;

use app\views\layouts\Layout;
use app\views\partials\Navbar;
use app\views\posts\NewPost;
use app\views\posts\Post;

class Home
{
    public function show($data, $posts): void
    {
        ob_start();
        ?>
<div class="category-feed">
    <?php if (isset($_SESSION['errorMessage'])) { ?>
    <p id="errorMessage"> <?= $_SESSION['errorMessage'] ?></p>
    <?php unset($_SESSION['errorMessage']); } ?>
</div>
<div class="feed">
<?php
echo (new NewPost())->show();
foreach ($posts as $post) {
    echo (new Post())->show($post);
}
?>
</div>
<div class="navbar-feed">
    <?= (new Navbar())->show($data) ?>
</div>
<?php
        (new Layout('PasX - Home', ob_get_clean(), 'home'))->show();
    }
}

?>