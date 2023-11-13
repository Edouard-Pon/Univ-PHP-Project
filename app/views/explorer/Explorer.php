<?php

namespace app\views\explorer;
error_reporting(E_ERROR | E_PARSE);
use app\views\layouts\Layout;
use app\views\partials\Navbar;

class Explorer
{
    public function show($searchResults, $allCategories): void
    {
        ob_start();
        ?>
        <div class="category-feed"></div>
        <div class="feed explorer-feed">
            <button class="btn btn-primary btn-navbar-phone" onclick="showNavBar()">Navigation</button>
            <form method="POST" action="/explorer" onsubmit="return validateSearch()">
                <input id="search" type="text" name="query" placeholder="Search...">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            <?php
            if (
                !empty($searchResults['posts']) ||
                !empty($searchResults['users']) ||
                !empty($searchResults['categories'])
            ) {
                echo (new SearchResult())->show($searchResults, $allCategories);
            } elseif (!empty($searchResults['criteria'])) {
                echo "<h1> No results found for " . $searchResults['criteria'] . "</h1>";
            }
            ?>
        </div>
        <div class="navbar-feed">
            <?= (new Navbar())->show() ?>
        </div>
        <script defer src="/assets/scripts/explorer.js"></script>
        <?php
        (new Layout('PasX - Profil', ob_get_clean(), 'home'))->show();
    }
}
?>
