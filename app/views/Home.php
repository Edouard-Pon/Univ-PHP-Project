<?php

namespace app\views;

class HomeView
{
    public function show($data, $posts): void
    {
        ob_start();
        ?>
<?php if (isset($_SESSION['errorMessage'])) { ?>
<p id="errorMessage"> <?= $_SESSION['errorMessage'] ?></p>
<?php unset($_SESSION['errorMessage']);
} ?>
<div class="category-feed">
    WIP
</div>
<div class="feed">
<?php
include('posts/new.php');
foreach ($posts as $post) {
    include('posts/post.php');
}
?>
</div>
<div class="navbar">
    <?= $data['username'] ?>
    <?php include('partials/navbar.php') ?>
</div>
<?php
        (new Layout('PasX - Home', ob_get_clean(), 'home'))->show();
    }
}

?>
