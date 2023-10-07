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
        <link rel="stylesheet" href="/public/assets/styles/termsofuse.css">
    </head>
    <body>
    <div id="margin"></div>
    <div id="posts">
        <p>Bacon ipsum dolor amet rump ball tip pig, ham hock pork chop drumstick leberkas pastrami biltong beef ribs sausage venison tongue spare ribs. Ham hock short ribs shoulder, venison turducken beef leberkas shankle kevin pork boudin ground round landjaeger salami meatball. Rump capicola fatback meatloaf meatball hamburger jowl biltong. Beef beef ribs meatloaf, frankfurter ham andouille tenderloin tail shankle ball tip. Alcatra bresaola ham prosciutto brisket chuck, beef ribs buffalo. Short loin brisket pancetta ground round, tail salami beef. Pork t-bone shank, corned beef ball tip doner pig meatball tongue fatback flank picanha beef boudin jerky.

            Prosciutto flank meatball frankfurter. Venison landjaeger sirloin buffalo pork chop sausage, kielbasa porchetta picanha meatloaf shankle corned beef chislic. Bacon spare ribs sirloin beef kielbasa bresaola, chislic picanha shoulder. Jerky turkey rump sausage meatloaf tail jowl tongue fatback cupim t-bone flank spare ribs strip steak.

            Landjaeger pastrami beef, burgdoggen ham hock buffalo chicken fatback drumstick capicola frankfurter chislic. Beef ribs tenderloin chislic filet mignon chicken venison spare ribs tongue. Tri-tip brisket chislic, strip steak fatback shankle pig beef pork kevin sausage. Pork chop brisket picanha, cupim tri-tip rump tongue alcatra short ribs andouille buffalo pastrami leberkas. Beef pork tenderloin andouille biltong. Meatloaf pork pork belly tenderloin bacon beef ribs kielbasa jerky boudin shoulder jowl tail. Short ribs pastrami chislic, buffalo pork chop spare ribs tongue strip steak chicken jerky.

            Ribeye pork loin kielbasa meatball chuck shankle ground round biltong flank picanha pork chop. Pork capicola pork belly, filet mignon pastrami ball tip fatback swine shankle doner ham. Meatball venison beef ham jowl jerky sausage beef ribs alcatra biltong chicken pork brisket. Turducken tail venison kielbasa bresaola. Capicola drumstick tail ground round boudin doner.

            Tri-tip hamburger porchetta buffalo tail, venison cupim ball tip meatloaf meatball fatback. Picanha pig capicola tail t-bone. Short loin corned beef porchetta ham, pork loin pork belly jerky. Short ribs ribeye pork chop, doner prosciutto shank corned beef andouille landjaeger. Swine cow buffalo jowl filet mignon kielbasa pork corned beef drumstick pancetta pork chop salami.</p>
    </div>
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
    <link rel="stylesheet" href="/public/assets/styles/termsofuse.css">
    <link rel="shortcut icon" type="image/jpg" href="/public/assets/images/logoblanc.png"/>
</head>
<body>
<header></header>
<div class="page-content">
    <div class="flex-container">
        <div class="logo"><img src="/public/assets/images/logoblanc.png" class="image" alt=""></div>
        <div class="interface">
            <p class="bigtext"><b>Résumé de nos conditions</b></p>
            <p class="minitext"> Ces Conditions d'utilisation font partie du Contrat d'utilisation, un document juridiquement contraignant qui régit votre utilisation de Z. Nous vous conseillons de lire ces Conditions d'utilisation dans leur intégralité, mais voici quelques éléments clés à retenir :

                Lorsque vous publiez du Contenu et utilisez les Services de quelque manière que ce soit, vous devez vous conformer au présent Contrat d'utilisation et à la Loi en vigueur : vous êtes responsable de votre utilisation des Services et de votre Contenu. Vous devez vous conformer au présent Contrat d'utilisation, aux politiques qu'il intègre et à toutes les lois en vigueur.<br>

                Vous devez respecter les conditions d'utilisation acceptables des Services : vous ne pouvez pas accéder aux Services autrement qu'au moyen des interfaces publiées actuellement disponibles que nous fournissons. Par exemple, cela signifie que vous ne pouvez pas scraper les Services, essayer de contourner les limites techniques que nous imposons ou tenter de perturber le fonctionnement des Services de quelque manière que ce soit.<br>

                Nous disposons d'une large marge de manœuvre pour faire appliquer ces Conditions : Z se réserve le droit de prendre des sanctions à votre encontre si vous les enfreignez. Nous pouvons, par exemple, supprimer votre Contenu, limiter sa visibilité, suspendre votre accès à Z ou vous poursuivre en justice. Nous pouvons également suspendre ou résilier votre compte pour d'autres raisons, telles qu'une inactivité prolongée, un risque d'ordre juridique ou l'absence de viabilité commerciale.<br>

                Ces Conditions intègrent des Licences de propriété intellectuelle : vous conservez la propriété de tout Contenu que vous publiez ou partagez ainsi que les droits sur celui‑ci, et vous nous accordez une large licence libre de droits pour mettre votre Contenu à la disposition du reste du monde et permettre aux autres utilisateurs de faire de même. Réciproquement, nous vous accordons une licence pour utiliser le logiciel que nous fournissons dans le cadre des Services, uniquement dans le but de vous permettre d'utiliser les Services et d'en profiter.<br>

                Votre utilisation des Services est à vos risques et périls : nous fournissons les Services « EN L'ÉTAT » et « TELS QUE DISPONIBLES », et nous déclinons toute garantie, obligation et responsabilité envers vous ou d'autres personnes dans la mesure permise par la loi. Vous pouvez être exposé à du contenu choquant ou préjudiciable publié par d'autres utilisateurs. Les Services peuvent changer de temps à autre, et nous pouvons à tout moment limiter leur disponibilité ou celles de fonctionnalités spécifiques pour vous ou d'autres utilisateurs, ou y mettre fin.<br>

                Vous disposez de dispositifs de recours, mais notre responsabilité est limitée : vous avez le droit de résilier cet accord à tout moment en désactivant votre compte et en cessant d'utiliser les Services. Notez que nous ne saurions être considérés comme responsables de certains types de dommages. Par ailleurs, si vous pensez que votre Contenu a été copié d'une manière qui constitue une violation des droits d'auteur, le processus de signalement est détaillé dans les présentes conditions.<br>

                Veuillez également noter que ces Conditions intègrent notre Politique de confidentialité ainsi que d'autres conditions applicables à votre utilisation des Services et à votre Contenu. Enfin, ces conditions peuvent varier en fonction de l'endroit où vous habitez, mais vous devez quoi qu'il en soit avoir au moins 13 ans pour utiliser Z.</p>
        </div>
    </div>
</div>
</body>
    <?php
}
?>
