<?php
session_start();
$config = parse_ini_file('../../config/db.ini');
if ($config === false) {
    die("Error loading configuration file.");
}
$bdd = new PDO($config['dsn'], $config['username'], $config['password']);

if (isset($_SESSION['name'])) {
    $username = $_SESSION['name'];
    echo "Connecté en tant que: " . $username. '<br><a href="disconnection.php">Se déconnecter<a/>' ;;
} else {
    echo "Vous n'êtes actuellment pas connecté. ". '<br><a href="connection.php">Se connecter<a/>' ;
}

if (isset($_POST["submit"])) {

    if (isset($_FILES["image"])) {
        $targetDir = "uploads/";
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
            $id = htmlspecialchars($_POST['id']);
            $titre = htmlspecialchars($_POST['titre']);
            $message = htmlspecialchars($_POST['message']);
            $date = htmlspecialchars($_POST['date']);
            $auteur = htmlspecialchars($_POST['auteur']);
            $imagepath = sha1($_POST['imagepath']); // Utilisation de sha1 pour le hachage du mot de passe
            $insertpost = $bdd->prepare('INSERT INTO posts (id, titre, message, date, auteur, imagepath) VALUES (?, ?, ?, ?, ?, ?, NOW())');
            $insertpost->execute(array($id, $titre, $message, $date, $auteur, $imagepath));
            $recuppost = $bdd->prepare('SELECT * FROM posts WHERE id = ? ');
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Créez un post</title>
</head>

<body>
<div class="phppot-container">
    <h1>Créez votre post</h1>
    <form action="upload" method="post" enctype="multipart/form-data">
        <textarea name = "titre" placeholder="Titre"></textarea>
        <br>
        <textarea name="message" placeholder="Votre message..."></textarea>
        <div class="row">
            <input type="file" name="image" required>
            <input type="submit" name="submit" value="Upload">
        </div>
    </form>

    <h1>Display uploaded Image:</h1>
    <?php if (isset($_FILES["image"]) && $uploadOk == 1) : ?>
        <img src="<?php echo $targetFile; ?>" alt="Uploaded Image">
    <?php endif; ?>
</div>
<a href="postspage.php">Voir tous les posts</a>

</body>

</html>