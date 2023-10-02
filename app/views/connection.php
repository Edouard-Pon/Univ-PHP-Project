<?php
session_start();
$config = parse_ini_file('../../config/db.ini');
if ($config === false) {
    die("Error loading configuration file.");
}
$bdd = new PDO($config['dsn'], $config['username'], $config['password']);

// Validation du formulaire
if (isset($_POST['envoi'])) {
    $error_message = "";
    if (!empty($_POST['name']) && !empty($_POST['password'])) {
        $name = htmlspecialchars($_POST['name']);
        $password = sha1($_POST['password']);

        $recupUser = $bdd->prepare('SELECT * FROM user WHERE name = ? AND password = ?');
        $recupUser->execute(array($name, $password));

        if ($recupUser->rowCount() > 0) {
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $recupUser->fetch()['id'];

            // Mettre à jour la date de dernière connexion
            $actuDate = $bdd->prepare('UPDATE user SET lastco = NOW() WHERE id = ?');
            $actuDate->execute(array($_SESSION['id']));
            if ($recupAdmin->rowCount() > 0) {
                $adminValue = $recupAdmin->fetch()['admin'];
                
                if ($adminValue == 1) {
                    header('Location: /app/views/adminpage.php');
                } elseif ($adminValue == 0) {
                    header('Location: /app/views/homepage.php');
            }    
        }
         else {
            $message = "Votre mot de passe ou nom d'utilisateur est incorrect...";
        }
    } else {
        $message = "Veuillez compléter tous les champs...";
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/public/assets/styles/main.css">
    <link rel="stylesheet" href="/public/assets/styles/connection.css"/>
</head>
<body>
    <div class="flex-container">
        <form method="POST" action="">
            <div class="logo"><img src="/public/assets/images/logoblanc.png" class="image" alt=""></div>

            <label for="username">Nom d'utilisateur:</label>
            <input class="inputText" id="username" type="text" name="name" autocomplete="off" placeholder="Entrez votre nom d'utilisateur">

            <label for="password">Mot de passe:</label>
            <input class="inputText" type="password" name="password" autocomplete="off" placeholder="Entrez votre mot de passe">

            <a href="register.php">Créer un compte</a>
            <input type="submit" name="envoi" id="submitButton">
            <p id="errorMessage"> <?php echo $message ?></p>
        </form>
    </div>
    <footer>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">À propos</a>
        <a href="https://www.univ-amu.fr/">IUT Aix-Marseille</a>
        <a href="https://github.com/Edouard-Pon/Univ-PHP-Project">Développeurs</a>
        <a>© 2023 Notre Equipe</a>
    </footer>
</body>
</html>