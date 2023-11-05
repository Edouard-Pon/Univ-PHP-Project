<?php

namespace app\views\partials;
error_reporting(E_ERROR | E_PARSE);
class Navbar
{
    public function show(): string
    {
        $pfp = $_SESSION['profile_picture'];
        if (!file_exists($pfp)) {
            $pfp = 'profiles/default/default.png';
        }
        ob_start();
?>
<nav class="navbar">
    <a href="/profile/<?= $_SESSION['username'] ?>">
        <img class="post-pfp" src="/<?= $pfp ?>" alt="Profile picture">
        <span class="nav-username">@<?= $_SESSION['username'] ?></span >
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
    <button class="btn btn-primary" id="closeNavbar" onclick="hideNavBar()">Close</button>
</nav>
<?php
        return ob_get_clean();
    }
}
?>

