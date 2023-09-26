
<?php
session_start(); // Démarre la session

$bdd = new PDO('dsn', 'username', 'password');

if(isset($_POST['envoi'])){
    if(!empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['email'] )){
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
            header('Location: connexion.php');

        } else {
            echo "Ce champ est requis";
        }
    }
}


?>

<!DOCTYPE html>
<html> 
    <head> 
        <title>Inscription</title> 
        <meta charset="utf-8">
</head> 
<body> 
    <form method="POST" action="">
        <input id="username" type="text" name="name" autocomplete="off" placeholder="Pseudo"> <br/>
        <input type="password" name="password" autocomplete="off" placeholder="Mot de passe"><br/>
        <input type="email" name="email"  placeholder="Adresse Mail" autocomplete="off"> <br/>
        <input type="tel" name="phone" id="user_phone" nputmode="numeric" placeholder="Téléphone"  pattern="[0-9]{10}"><br/>
        <select id="user_country" name="location"> <!-- Pays -->
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
    </select> <br>
    <select id="user_sexe" name="gender"> <!-- sexe -->
        <option value=""> --Choisissez un sexe--</option>
        <option value="M">Homme</option>
        <option value="F">Femme</option>
        <option value="Helico_de_combat">Hélicoptère de combat</option>
        <option value="Adaptateur_Usb">Adaptateur USB</option>
    </select> <br>
        <br/><br/>
        <input type="submit" name="envoi">
        
    </form>
</body> 
</html>

