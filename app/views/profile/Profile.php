<?php

namespace app\views\profile;
error_reporting(E_ERROR | E_PARSE);
use app\views\layouts\Layout;
use app\views\partials\Navbar;
use app\views\posts\NewPost;
use app\views\posts\Post;

class Profile
{
    public function show($data, $posts, $categories ,$categoriesNames, bool $edit = false, bool $isOwner = false): void
    {
        ob_start();
        echo (new NewPost())->show($categoriesNames);
        ?>
        <div class="category-feed">
        <?php if (isset($_SESSION['errorMessage'])) { ?>
            <p id="errorMessage"> <?= $_SESSION['errorMessage'] ?></p>
        <?php unset($_SESSION['errorMessage']); } ?>
        </div>
        <div class="feed">

            <?php if ($edit) echo (new Edit())->show($data) ?>

            <div class="profile">
                <div>
                    <div class="bg-pfp">
                        <img src="/profiles/default/default_banner.png" alt="Background profile picture">
                    </div>
                    <div class="profile-top">
                        <img class="pfp" src="/<?= $data['profile_picture'] ?: 'profiles/default/default.png' ?>" alt="Image">
                        <?php if ($isOwner) { ?>
                        <a class="btn btn-primary btn-edit" href="/profile/edit">Edit Profile</a>
                        <?php } ?>
                    </div>
                </div>
                <ul class="name">
                    <li class="nickname"><?= $data['nickname'] ?></li>
                    <li class="username">@<?= $data['username'] ?></li>
                </ul>
                <ul class="other">
                    <li>Gender: <?= $data['gender'] ?></li>
                    <li>Location: <?= $data['location'] ?></li>
                    <li>First connection: <?= $data['firstco'] ?></li>
                    <li>Last connection: <?= $data['lastco'] ?></li>
                </ul>
            </div>

            <?php
            foreach ($posts as $post) {
                echo (new Post())->show($post, $categories);
            }
            ?>
        </div>

        <div class="navbar-feed">
            <?= (new Navbar())->show() ?>
        </div>
        <?php
        (new Layout('PasX - Profil', ob_get_clean(), 'profile'))->show();
    }
}
?>
