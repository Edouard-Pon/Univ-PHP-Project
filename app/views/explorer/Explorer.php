<?php

namespace app\views\explorer;
error_reporting(E_ERROR | E_PARSE);
use app\views\layouts\Layout;
use app\views\partials\Navbar;

class Explorer
{
    public function show($searchResults = null): void
    {
        ob_start();
        ?>
        <div class="category-feed"></div>
        <div class="feed explorer-feed">
            <button class="btn btn-primary btn-navbar-phone" onclick="showNavBar()">Navigation</button>
            <form method="POST" action="/explorer">
                <input id="search" type="text" name="query" placeholder="Search...">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            <?php
            if ($searchResults != null) {
                // Loop through $searchResults to display the results.
                foreach ($searchResults as $result) {
                    // Display the search results (e.g., titles, usernames, category names).
                    echo (new SearchResult())->show($result);
                }
            }
            ?>
        </div>
        <div class="navbar-feed">
            <?= (new Navbar())->show() ?>
        </div>
        <?php
        (new Layout('PasX - Profil', ob_get_clean(), 'home'))->show();
    }
}
?>
