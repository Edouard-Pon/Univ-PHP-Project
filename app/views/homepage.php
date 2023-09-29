<?php
session_start();
if (!isset($_SESSION['password'])){
    start_page('PasX');
    exit;
}
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
echo $_SESSION ['name'];
log_out();
?>

<?php
function log_out()
{
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Home</title>
    <meta charset="utf-8">
</head>
<body>
    <a href="disconnection.php">
        <button>Se déconnecter</button>
    </a>
</body> 
</html>
<?php
}
?>


<?php
function start_page($title)
{
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/public/assets/styles/main.css">
    <link rel="stylesheet" href="/public/assets/styles/homepage.css">

    <link rel="shortcut icon" type="image/jpg" href="/public/assets/images/logoblanc.png"/>
</head>
<body>
<header></header>
<div class="page-content">
    <div class="flex-container">
        <div class="logo"><img src="/public/assets/images/logoblanc.png" class="image" alt=""></div>
        <div class="interface">
            <p class="bigtext"><b>Nous aussi on <br>peut le faire</b></p>
            <p class="medtext"><b>Rejoignez dès aujourd'hui</b></p>
            <button onclick="window.location.href='register.php';" class="signup"><b>Créer un compte</b></button>
            <p class="minitext">En vous inscrivant, vous acceptez les conditions d'utilisation et de confidentialité<br> Politique incluant l'utilisation des cookies.</p>
            <p class="medtext"><b>Déja un compte?</b></p>
            <button onclick="window.location.href='connection.php';" class="signin"><b>Se connecter</b></button>
        </div>
    </div>
    <footer>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">À propos</a>
        <a href="https://www.univ-amu.fr/">IUT Aix-Marseille</a>
        <a href="https://github.com/Edouard-Pon/Univ-PHP-Project">Développeurs</a>
        <a>© 2023 Notre Equipe</a>
    </footer>
</div>
</body>
<?php
}
?>
