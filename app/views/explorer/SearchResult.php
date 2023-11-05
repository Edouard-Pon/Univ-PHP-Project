<?php

namespace app\views\explorer;
error_reporting(E_ERROR | E_PARSE);
class SearchResult
{
    public function show($searchResults): string
    {
        ob_start();
?>
<div>
    <a href="/profile/<?= $searchResults['post_author'] ?>/post/<?= $searchResults['id'] ?>"><?= $searchResults['post_text'] ?></a>
</div>
<div>
    <a href="/profile/<?= $searchResults['username'] ?>">@<?= $searchResults['username'] ?></a>
</div>
<div>
    <a href="/category/<?= $searchResults['category_name'] ?>"><?= $searchResults['category_name'] ?></a>
</div>
<?php
        return ob_get_clean();
    }
}
?>
