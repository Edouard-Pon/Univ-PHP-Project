<?php

namespace app\views\profile;

use app\views\layouts\Layout;
use app\views\partials\Navbar;
use app\views\posts\NewPost;
use app\views\posts\Post;

class Profile
{
    public function show($data, $posts, $AllCategories, bool $edit = false, bool $isOwner = false): void
    {
        ob_start();
        echo (new NewPost())->show($AllCategories);
        ?>
        <div class="category-feed">
        </div>
        <div class="feed">

            <?php if ($edit) echo (new Edit())->show() ?>

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
                echo (new Post())->show($post);
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
