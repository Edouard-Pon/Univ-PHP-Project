<?php

if (isset($_SESSION['name'])) {
    $username = $_SESSION['name'];
//    echo "Connecté en tant que: " . $username. '<br><a href="disconnection.php">Se déconnecter<a/>' ;;
} else {
//    echo "Vous n'êtes actuellment pas connecté. ". '<br><a href="/login">Connectez-vous pour poster<a/>' ;
}

if ((isset($_POST["submit"])) && (isset($_SESSION['name']))) {

    if (isset($_FILES["image"])) {
        $targetDir = 'posts/'.$username.'/';

        // Checking whether file exists or not
        if (!file_exists($targetDir)) {

            // Create a new file or direcotry
            mkdir($targetDir, 0777, true);
        }
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "Le fichier doit être une image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }
    }


    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }


    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            $titre = htmlspecialchars($_POST['titre']);
            $message = htmlspecialchars($_POST['message']);
            $date = date('Y-m-d h:i:s a', time());
            $auteur = htmlspecialchars($_SESSION['name']);
            $post_path = $targetFile;
            $insertpost = $bdd->prepare('INSERT INTO posts (titre, message, date, auteur, post_path) VALUES (?, ?, ?, ?, ?)');
            $insertpost->bindParam(1, $titre);
            $insertpost->bindParam(2, $message);
            $insertpost->bindParam(3, $date);
            $insertpost->bindParam(4, $auteur);
            $insertpost->bindParam(5, $post_path, PDO::PARAM_LOB);
            $insertpost->execute();
            $recuppost = $bdd->prepare('SELECT * FROM posts WHERE id = ? ');
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<?php
class CreatePostView
{
public function show(): void
{
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Créez un post</title>
</head>

<body>
<div class="phppot-container">
    <h1>Créez votre post</h1>
    <?php if (isset($_SESSION['name']))
        echo '<form action="" method="post" enctype="multipart/form-data">
        <textarea name = "titre" placeholder="Titre"></textarea>
        <br>
        <textarea name="message" placeholder="Votre message... (optionnel)"></textarea>
        <div class="row">
            <input type="file" name="image" required>
            <input type="submit" name="submit" value="Upload">
        </div>
    </form>' ?>

    <?php if (isset($_FILES["image"]) && $uploadOk == 1) : ?>
        <h1>Image uploadée: <?php echo $post_path?></h1>
        <img src="<?php echo $post_path; ?>" alt="Uploaded Image">
    <?php endif; ?>
</div>
<a href="postpage.php">Voir tous les posts</a>

</body>

</html>

        <?php
        include 'partials/footer.php';
        (new Layout('PasX', ob_get_clean(), 'welcome'))->show();
    }
}
?>

