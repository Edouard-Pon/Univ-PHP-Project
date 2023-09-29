<?php
session_start();
$config = parse_ini_file('../../config/db.ini');
if ($config === false) {
    die("Error loading configuration file.");
}
$bdd = new PDO($config['dsn'], $config['username'], $config['password']);

// Validation du formulaire
if (isset($_POST['envoi'])) {
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

            header('Location: index.php');
        } else {
            echo "Votre mot de passe ou nom d'utilisateur est incorrect...";
        }
    } else {
        echo "Veuillez compléter tous les champs...";
    }
}
?>
<!DOCTYPE html>
<html> 
    <head> 
        <title>Connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/public/assets/styles/connection.css"/>
    </head> 
    <body> 
        <form method="POST" action="">
            <img src="/public/assets/images/logoblanc.png" width="50" height="50">
            <input class="inputText" id="username" type="text" name="name" autocomplete="off" placeholder="Nom d'utilisateur"> <br/>
            <input class="inputText" type="password" name="password" autocomplete="off" placeholder="Mot de passe"><br/>
            <br/><br/>
            <input type="submit" name="envoi" id="submitButton">
        </form>
    </body> 
</html>
