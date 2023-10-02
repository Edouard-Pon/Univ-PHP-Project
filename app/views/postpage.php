<!DOCTYPE html>
<html>
<head>
    <title>Images in Posts</title>
    <link rel="stylesheet" href="../../public/assets/styles/postpage.css">
</head>
<body>
<?php
try {
    $config = parse_ini_file('../../config/db.ini');
    if ($config === false) {
        die("Error loading configuration file.");
    }

    // Create a PDO instance
    $pdo = new PDO($config['dsn'], $config['username'], $config['password']);

    $stmt = $pdo->query("SELECT post_path, titre, auteur FROM posts");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $file_path = $row['post_path'];
        $title = $row['titre'];
        $author = $row['auteur'];

        // Check if the file exists
        if (file_exists($file_path)) {
            // Display the image along with title and author
            echo '<div class="post-container">';
            echo '<h2>' . htmlspecialchars($title) . '</h2>';
            echo '<p>Author: ' . htmlspecialchars($author) . '</p>';
            echo '<div class="image-container">';
            echo '<img src="' . $file_path . '" alt="Image">';
            echo '</div>';
            echo '</div>';
        }
    }
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
</body>
</html>


