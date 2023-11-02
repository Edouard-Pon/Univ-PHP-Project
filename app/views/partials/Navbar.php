<?php

namespace app\views\partials;

class Navbar
{
    public function show($data): string
    {
        if (!file_exists($data['profile_picture'])) {
            $data['profile_picture'] = 'profiles/default/default.png';
        }
        ob_start();
?>
<nav class="navbar">
    <a href="/profile/<?= $data['username'] ?>">
        <img class="post-pfp" src="/<?= $data['profile_picture'] ?>" alt="Profile picture">
        <span class="nav-username">@<?= $data['username'] ?></span >
    </a>
    <a href="/home">
        <img class="nav-logo" src="/assets/images/acceuilX.png" alt="Image Acceuil">
        <span class="nav-title">Accueil</span>
    </a>
    <a href="/explorer">
        <img class="nav-logo" src="/assets/images/explorerX.png" alt="Image Rechercher">
        <span class="nav-title">Explorer</span>
    </a>
    <a href="/profile">
        <img class="nav-logo" src="/assets/images/profilX.png" alt="Image Profil">
        <span class="nav-title">Profil</span>
    </a>
    <button class="btn btn-primary" onclick="showNewPostForm()">Post</button>
    <button class="btn btn-danger" onclick="location.href = '/logout'">Logout</button>
</nav>
<?php
        return ob_get_clean();
    }
}
?>

