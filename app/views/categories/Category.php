<?php

namespace app\views\categories;
error_reporting(E_ERROR | E_PARSE);
class Category
{
    public function show(array $categories): string
    {
        ob_start();
        ?>
        <p class="category-text">
            <?php
                echo "Categories: <br>";
                foreach ($categories as $category) {
                    echo $category . "<br>";

            }
            ?>
        </p>
        <?php
        return ob_get_clean();
    }
}