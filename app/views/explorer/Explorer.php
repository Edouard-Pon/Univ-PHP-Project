<?php

namespace app\views\explorer;
error_reporting(E_ERROR | E_PARSE);
use app\views\layouts\Layout;

class Explorer
{
    public function show($searchResults = null): void
    {
        ob_start();
        ?>
        <form method="POST" action="/explorer">
            <input type="text" name="query" placeholder="Search...">
            <button type="submit">Search</button>
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
        <?php
        (new Layout('PasX - Profil', ob_get_clean(), 'profile'))->show();
    }
}
?>
