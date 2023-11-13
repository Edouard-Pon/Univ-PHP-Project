<?php

namespace app\views\explorer;
use app\views\layouts\Layout;
use app\views\posts\Post;

error_reporting(E_ERROR | E_PARSE);
class SearchResult
{
    public function show($searchResults,$allCategories): void
    {
        ob_start();
        ?>
        <div class="explorer">
            <h1>Posts containing "<?= $searchResults['criteria']?>"</h1>
            <?php
            if (!empty($searchResults['posts'])){
            foreach ($searchResults['posts'] as $result):
                echo (new Post())->show($result, $allCategories);
            endforeach;
            }
            else echo "No posts found for ". $searchResults['criteria']?>
        </div>
        <div class="explorer">
            <h1>Users containing "<?= $searchResults['criteria']?>"</h1>
            <?php
            if (!empty($searchResults['users'])){
            foreach ($searchResults['users'] as $result): ?>
                <?php
                $pfp = 'profiles/' . $result['post_author'] . '/' . $result['post_author'] . '.jpg';
                if (!file_exists($pfp)) {
                    $pfp = 'profiles/default/default.png';
                }
                ?>
                <div class="user-info">
                    <div class="post-pfp">
                        <img src="/<?= $pfp ?>" alt="Profile picture">
                    </div>
                    <a href="/profile/<?= $result['username'] ?>">@<?= $result['username'] ?></a>
                </div>
            <?php endforeach;
            }
            else echo "No users found for ". $searchResults['criteria']?>
        </div>
        <div class="explorer">
            <h1>Categories containing "<?= $searchResults['criteria']?>"</h1>
            <?php
            if (!empty($searchResults['categories'])){
            foreach ($searchResults['categories'] as $result): ?>
                <div><a href="/category/<?= $result['category_name'] ?>">#<?= $result['category_name'] ?></a></div><br>
            <?php endforeach;
            }
            else echo "No categories found for ". $searchResults['criteria']?>
        </div>
        <?php
        (new Layout('PasX - Results', ob_get_clean(), 'shared/post'))->show();
    }
}

?>
