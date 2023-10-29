<?php

namespace app\views\partials;

class Navbar
{
    public function show(): string
    {
        ob_start();
?>
<div id="navbar_self">
    <a href="/home">
        <div>
            <img src="/assets/images/acceuilX.png" alt="Image Acceuil">
            <span>Accueil</span>
        </div>
    </a>
    <a href="/explorer">
        <div>
            <img src="/assets/images/explorerX.png" alt="Image Rechercher">
            <span>Explorer</span>
        </div>
    </a>
    <a href="/profile">
        <div>
            <img src="/assets/images/profilX.png" alt="Image Profil">
            <span>Profil</span>
        </div>
    </a>
    <a>
        <button onclick="showNewPostForm()">New Post</button>
    </a>
    <a href="/logout">
        <button>Disconnect</button>
    </a>
</div>
<?php
        return ob_get_clean();
    }
}
?>
