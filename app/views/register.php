<?php
session_start(); // Démarre la session

$bdd = new PDO('dsn', 'username', 'password');

if(isset($_POST['envoi'])){
    $errorMessage ="";
    if(!empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['email'])&& !empty($_POST['phone'])&& !empty($_POST['gender'])&& !empty($_POST['location'])){
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $location = htmlspecialchars($_POST['location']);
        $gender = htmlspecialchars($_POST['gender']);
        $password = sha1($_POST['password']); // Utilisation de sha1 pour le hachage du mot de passe
        $insertUser = $bdd->prepare('INSERT INTO user (name, password, email, phone, location, gender, firstco) VALUES (?, ?, ?, ?, ?, ?, NOW())');
        $insertUser->execute(array($name, $password, $email, $phone, $location, $gender));
        $recupUser = $bdd->prepare('SELECT * FROM user WHERE name = ? AND password = ?');

        $recupUser->execute(array($name, $password));
        if ($recupUser->rowCount() > 0){
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $recupUser->fetch()['id'];
            header('Location: /app/views/connexion.php');
        }
    }
    else {
        $errorMessage = "Veuillez remplir tous les champs...";
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
<div class="page-content">
    <div class="flex-container">
        <form method="POST" action="">
            <div class="logo"><img src="/public/assets/images/logoblanc.png" class="image" alt=""></div>
            <label for="username">Pseudo:</label>
            <input class="inputText" id="username" type="text" name="name" autocomplete="off" placeholder="Entrez votre pseudo">

            <label for="password">Mot de passe:</label>
            <input class="inputText" type="password" name="password" autocomplete="off" placeholder="Entrez votre mot de passe">

            <label for="email">Adresse Mail:</label>
            <input class="inputText" type="email" name="email" placeholder="Entrez votre adresse mail" autocomplete="off">

            <label for="user_phone">Téléphone:</label>
            <input class="inputText" type="tel" name="phone" id="user_phone" inputmode="numeric" placeholder="Entrez votre numéro de téléphone" pattern="[0-9]{10}">

            <label for="user_country">Pays:</label>
            <select class="inputSelect" id="user_country" name="location">
                <option value=""> ---Choisissez un pays---</option>
                <option value="Fr"> France</option>
                <option value="Ua"> Ukraine</option>
                <option value="Li"> Listembourg</option>
                <option value="Uk"> Royaume-Unis</option>
                <option value="Lu"> Luxembourg</option>
                <option value="Zi"> Zimbabwe</option>
                <option value="Ma"> Mars</option>
                <option value="Ai"> Aix-En-Provence</option>
                <option value="Iu"> IUT</option>
            </select>

            <label for="user_sexe">Sexe:</label>
            <select class="inputSelect" id="user_sexe" name="gender">
                <option value=""> --Choisissez un sexe--</option>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
                <option value="Helico_de_combat">Hélicoptère de combat</option>
                <option value="Adaptateur_Usb">Adaptateur USB</option>
            </select>

            <input type="submit" name="envoi">
            <p><?php echo $errorMessage ?></p>
        </form>
    </div>
    <footer>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">À propos</a>
        <a href="https://www.univ-amu.fr/">IUT Aix-Marseille</a>
        <a href="https://github.com/Edouard-Pon/Univ-PHP-Project">Développeurs</a>
        <a>© 2023 Notre Equipe</a>
    </footer>
</div>
</body> 
</html>

