<?php
class HomeView
{
    public function show($data, $posts): void
    {
        ob_start();
?>
<?php if (isset($_SESSION['errorMessage'])) { ?>
<p id="errorMessage"> <?= $_SESSION['errorMessage'] ?></p>
<?php unset($_SESSION['errorMessage']); } ?>
<div id="right_informations">
    <?= $data['name']?>
    <?php include('partials/navbar.php')?>
</div>
<?php
include('posts/new.php');
foreach ($posts as $post) {
include('posts/post.php');
}
        (new Layout('PasX - Home', ob_get_clean(), 'home'))->show();
    }
}
?>
