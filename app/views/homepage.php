<?php
session_start();
if (!isset($_SESSION['password'])){
    start_page('PasX');
    exit;
}
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
//echo $_SESSION ['name'];
//log_out();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/public/assets/styles/homepage.css">
</head>
<body>
<div id="margin"></div>
<div id="posts">
    <p>Bacon ipsum dolor amet rump ball tip pig, ham hock pork chop drumstick leberkas pastrami biltong beef ribs sausage venison tongue spare ribs. Ham hock short ribs shoulder, venison turducken beef leberkas shankle kevin pork boudin ground round landjaeger salami meatball. Rump capicola fatback meatloaf meatball hamburger jowl biltong. Beef beef ribs meatloaf, frankfurter ham andouille tenderloin tail shankle ball tip. Alcatra bresaola ham prosciutto brisket chuck, beef ribs buffalo. Short loin brisket pancetta ground round, tail salami beef. Pork t-bone shank, corned beef ball tip doner pig meatball tongue fatback flank picanha beef boudin jerky.

        Prosciutto flank meatball frankfurter. Venison landjaeger sirloin buffalo pork chop sausage, kielbasa porchetta picanha meatloaf shankle corned beef chislic. Bacon spare ribs sirloin beef kielbasa bresaola, chislic picanha shoulder. Jerky turkey rump sausage meatloaf tail jowl tongue fatback cupim t-bone flank spare ribs strip steak.

        Landjaeger pastrami beef, burgdoggen ham hock buffalo chicken fatback drumstick capicola frankfurter chislic. Beef ribs tenderloin chislic filet mignon chicken venison spare ribs tongue. Tri-tip brisket chislic, strip steak fatback shankle pig beef pork kevin sausage. Pork chop brisket picanha, cupim tri-tip rump tongue alcatra short ribs andouille buffalo pastrami leberkas. Beef pork tenderloin andouille biltong. Meatloaf pork pork belly tenderloin bacon beef ribs kielbasa jerky boudin shoulder jowl tail. Short ribs pastrami chislic, buffalo pork chop spare ribs tongue strip steak chicken jerky.

        Ribeye pork loin kielbasa meatball chuck shankle ground round biltong flank picanha pork chop. Pork capicola pork belly, filet mignon pastrami ball tip fatback swine shankle doner ham. Meatball venison beef ham jowl jerky sausage beef ribs alcatra biltong chicken pork brisket. Turducken tail venison kielbasa bresaola. Capicola drumstick tail ground round boudin doner.

        Tri-tip hamburger porchetta buffalo tail, venison cupim ball tip meatloaf meatball fatback. Picanha pig capicola tail t-bone. Short loin corned beef porchetta ham, pork loin pork belly jerky. Short ribs ribeye pork chop, doner prosciutto shank corned beef andouille landjaeger. Swine cow buffalo jowl filet mignon kielbasa pork corned beef drumstick pancetta pork chop salami.
        Bacon ipzarezal tip pig, ham hock pork chop drumstick leberkas pastrami biltong beef ribs sausage venison tongue spare ribs. Ham hock short ribs shoulder, venison turducken beef leberkas shankle kevin pork boudin ground round landjaeger salami meatball. Rump capicola fatback meatloaf meatball hamburger jowl biltong. Beef beef ribs meatloaf, frankfurter ham andouille tenderloin tail shankle ball tip. Alcatra bresaola ham prosciutto brisket chuck, beef ribs buffalo. Short loin brisket pancetta ground round, tail salami beef. Pork t-bone shank, corned beef ball tip doner pig meatball tongue fatback flank picanha beef boudin jerky.

        Prosciutto flank meatball frankfurter. Venison landjaeger sirloin buffalo pork chop sausage, kielbasa porchetta picanha meatloaf shankle corned beef chislic. Bacon spare ribs sirloin beef kielbasa bresaola, chislic picanha shoulder. Jerky turkey rump sausage meatloaf tail jowl tongue fatback cupim t-bone flank spare ribs strip steak.

        Landjaeger pastrami beef, burgdoggen ham hock buffalo chicken fatback drumstick capicola frankfurter chislic. Beef ribs tenderloin chislic filet mignon chicken venison spare ribs tongue. Tri-tip brisket chislic, strip steak fatback shankle pig beef pork kevin sausage. Pork chop brisket picanha, cupim tri-tip rump tongue alcatra short ribs andouille buffalo pastrami leberkas. Beef pork tenderloin andouille biltong. Meatloaf pork pork belly tenderloin bacon beef ribs kielbasa jerky boudin shoulder jowl tail. Short ribs pastrami chislic, buffalo pork chop spare ribs tongue strip steak chicken jerky.

        Ribeye pork loin kielbasa meatball chuck shankle ground round biltong flank picanha pork chop. Pork capicola pork belly, filet mignon pastrami ball tip fatback swine shankle doner ham. Meatball venison beef ham jowl jerky sausage beef ribs alcatra biltong chicken pork brisket. Turducken tail venison kielbasa bresaola. Capicola drumstick tail ground round boudin doner.

        Tri-tip hamburger porchetta buffalo tail, venison cupim ball tip meatloaf meatball fatback. Picanha pig capicola tail t-bone. Short loin corned beef porchetta ham, pork loin pork belly jerky. Short ribs ribeye pork chop, doner prosciutto shank corned beef andouille landjaeger. Swine cow buffalo jowl filet mignon kielbasa pork corned beef drumstick pancetta pork chop salami.
        Bacon ipsum dolor amet rump ball tip pig, ham hock pork chop drumstick leberkas pastrami biltong beef ribs sausage venison tongue spare ribs. Ham hock short ribs shoulder, venison turducken beef leberkas shankle kevin pork boudin ground round landjaeger salami meatball. Rump capicola fatback meatloaf meatball hamburger jowl biltong. Beef beef ribs meatloaf, frankfurter ham andouille tenderloin tail shankle ball tip. Alcatra bresaola ham prosciutto brisket chuck, beef ribs buffalo. Short loin brisket pancetta ground round, tail salami beef. Pork t-bone shank, corned beef ball tip doner pig meatball tongue fatback flank picanha beef boudin jerky.

        Prosciutto flank meatball frankfurter. Venison landjaeger sirloin buffalo pork chop sausage, kielbasa porchetta picanha meatloaf shankle corned beef chislic. Bacon spare ribs sirloin beef kielbasa bresaola, chislic picanha shoulder. Jerky turkey rump sausage meatloaf tail jowl tongue fatback cupim t-bone flank spare ribs strip steak.

        Landjaeger pastrami beef, burgdoggen ham hock buffalo chicken fatback drumstick capicola frankfurter chislic. Beef ribs tenderloin chislic filet mignon chicken venison spare ribs tongue. Tri-tip brisket chislic, strip steak fatback shankle pig beef pork kevin sausage. Pork chop brisket picanha, cupim tri-tip rump tongue alcatra short ribs andouille buffalo pastrami leberkas. Beef pork tenderloin andouille biltong. Meatloaf pork pork belly tenderloin bacon beef ribs kielbasa jerky boudin shoulder jowl tail. Short ribs pastrami chislic, buffalo pork chop spare ribs tongue strip steak chicken jerky.

        Ribeye pork loin kielbasa meatball chuck shankle ground round biltong flank picanha pork chop. Pork capicola pork belly, filet mignon pastrami ball tip fatback swine shankle doner ham. Meatball venison beef ham jowl jerky sausage beef ribs alcatra biltong chicken pork brisket. Turducken tail venison kielbasa bresaola. Capicola drumstick tail ground round boudin doner.

        Tri-tip hamburger porchetta buffalo tail, venison cupim ball tip meatloaf meatball fatback. Picanha pig capicola tail t-bone. Short loin corned beef porchetta ham, pork loin pork belly jerky. Short ribs ribeye pork chop, doner prosciutto shank corned beef andouille landjaeger. Swine cow buffalo jowl filet mignon kielbasa pork corned beef drumstick pancetta pork chop salami.
        Bacon ipsum dolor amet rump ball tip pig, ham hock pork chop drumstick leberkas pastrami biltong beef ribs sausage venison tongue spare ribs. Ham hock short ribs shoulder, venison turducken beef leberkas shankle kevin pork boudin ground round landjaeger salami meatball. Rump capicola fatback meatloaf meatball hamburger jowl biltong. Beef beef ribs meatloaf, frankfurter ham andouille tenderloin tail shankle ball tip. Alcatra bresaola ham prosciutto brisket chuck, beef ribs buffalo. Short loin brisket pancetta ground round, tail salami beef. Pork t-bone shank, corned beef ball tip doner pig meatball tongue fatback flank picanha beef boudin jerky.

        Prosciutto flank meatball frankfurter. Venison landjaeger sirloin buffalo pork chop sausage, kielbasa porchetta picanha meatloaf shankle corned beef chislic. Bacon spare ribs sirloin beef kielbasa bresaola, chislic picanha shoulder. Jerky turkey rump sausage meatloaf tail jowl tongue fatback cupim t-bone flank spare ribs strip steak.

        Landjaeger pastrami beef, burgdoggen ham hock buffalo chicken fatback drumstick capicola frankfurter chislic. Beef ribs tenderloin chislic filet mignon chicken venison spare ribs tongue. Tri-tip brisket chislic, strip steak fatback shankle pig beef pork kevin sausage. Pork chop brisket picanha, cupim tri-tip rump tongue alcatra short ribs andouille buffalo pastrami leberkas. Beef pork tenderloin andouille biltong. Meatloaf pork pork belly tenderloin bacon beef ribs kielbasa jerky boudin shoulder jowl tail. Short ribs pastrami chislic, buffalo pork chop spare ribs tongue strip steak chicken jerky.

        Ribeye pork loin kielbasa meatball chuck shankle ground round biltong flank picanha pork chop. Pork capicola pork belly, filet mignon pastrami ball tip fatback swine shankle doner ham. Meatball venison beef ham jowl jerky sausage beef ribs alcatra biltong chicken pork brisket. Turducken tail venison kielbasa bresaola. Capicola drumstick tail ground round boudin doner.

        Tri-tip hamburger porchetta buffalo tail, venison cupim ball tip meatloaf meatball fatback. Picanha pig capicola tail t-bone. Short loin corned beef porchetta ham, pork loin pork belly jerky. Short ribs ribeye pork chop, doner prosciutto shank corned beef andouille landjaeger. Swine cow buffalo jowl filet mignon kielbasa pork corned beef drumstick pancetta pork chop salami.</p>
</div>
<div id="navbar">
    <?php
    require('partials/navbar.php');
    ?>
</div>
</body>
</html>
<?php
//function log_out()
//{
//?>
<!--<body>-->
<!--    <a href="disconnection.php">-->
<!--        <button>Se déconnecter</button>-->
<!--    </a>-->
<!--</body>-->
<!--</html>-->
<?php
//}
//?>


<?php
function start_page($title)
{
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/public/assets/styles/main.css">
    <link rel="stylesheet" href="/public/assets/styles/welcome.css">

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
            <p class="minitext">En vous inscrivant, vous acceptez les conditions d'utilisation et de confidentialité<br> Politique incluant l'utilisation des cookies. <a href="termsofuse.php"> Ici </a> </p>
            <p class="medtext"><b>Déja un compte?</b></p>
            <button onclick="window.location.href='connection.php';" class="signin"><b>Se connecter</b></button>
        </div>
    </div>
    <footer>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">À propos</a>
        <a href="https://www.univ-amu.fr/">IUT Aix-Marseille</a>
        <a href="https://github.com/Edouard-Pon/Univ-PHP-Project">Développeurs</a>
        <a href ="https://cdn.discordapp.com/attachments/850441665146912828/1159742886032711720/image.png?ex=653221bb&is=651facbb&hm=6e5a4c4c56833950786695ebcace79e943936915df2a6800119ccb6c342d9c23&">© 2023 Notre Equipe</a>
    </footer>
</div>
</body>
<?php
}
?>
