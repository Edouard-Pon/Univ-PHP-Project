<?php

namespace app\views;

class TOS
{
    public function show(): void
    {
        ob_start();
        ?>
        <div id="marginLeft"></div>
        <div id="posts">
            <p class="bigtext"><b>Résumé de nos conditions :</b></p>
            <p> Ces Conditions d'utilisation font partie du Contrat d'utilisation, un document juridiquement contraignant qui régit votre utilisation de Z. Nous vous conseillons de lire ces Conditions d'utilisation dans leur intégralité, mais voici quelques éléments clés à retenir :

                Lorsque vous publiez du Contenu et utilisez les Services de quelque manière que ce soit, vous devez vous conformer au présent Contrat d'utilisation et à la Loi en vigueur : vous êtes responsable de votre utilisation des Services et de votre Contenu. Vous devez vous conformer au présent Contrat d'utilisation, aux politiques qu'il intègre et à toutes les lois en vigueur.<br>

                Vous devez respecter les conditions d'utilisation acceptables des Services : vous ne pouvez pas accéder aux Services autrement qu'au moyen des interfaces publiées actuellement disponibles que nous fournissons. Par exemple, cela signifie que vous ne pouvez pas scraper les Services, essayer de contourner les limites techniques que nous imposons ou tenter de perturber le fonctionnement des Services de quelque manière que ce soit.<br>

                Nous disposons d'une large marge de manœuvre pour faire appliquer ces Conditions : Z se réserve le droit de prendre des sanctions à votre encontre si vous les enfreignez. Nous pouvons, par exemple, supprimer votre Contenu, limiter sa visibilité, suspendre votre accès à Z ou vous poursuivre en justice. Nous pouvons également suspendre ou résilier votre compte pour d'autres raisons, telles qu'une inactivité prolongée, un risque d'ordre juridique ou l'absence de viabilité commerciale.<br>

                Ces Conditions intègrent des Licences de propriété intellectuelle : vous conservez la propriété de tout Contenu que vous publiez ou partagez ainsi que les droits sur celui‑ci, et vous nous accordez une large licence libre de droits pour mettre votre Contenu à la disposition du reste du monde et permettre aux autres utilisateurs de faire de même. Réciproquement, nous vous accordons une licence pour utiliser le logiciel que nous fournissons dans le cadre des Services, uniquement dans le but de vous permettre d'utiliser les Services et d'en profiter.<br>

                Votre utilisation des Services est à vos risques et périls : nous fournissons les Services « EN L'ÉTAT » et « TELS QUE DISPONIBLES », et nous déclinons toute garantie, obligation et responsabilité envers vous ou d'autres personnes dans la mesure permise par la loi. Vous pouvez être exposé à du contenu choquant ou préjudiciable publié par d'autres utilisateurs. Les Services peuvent changer de temps à autre, et nous pouvons à tout moment limiter leur disponibilité ou celles de fonctionnalités spécifiques pour vous ou d'autres utilisateurs, ou y mettre fin.<br>

                Vous disposez de dispositifs de recours, mais notre responsabilité est limitée : vous avez le droit de résilier cet accord à tout moment en désactivant votre compte et en cessant d'utiliser les Services. Notez que nous ne saurions être considérés comme responsables de certains types de dommages. Par ailleurs, si vous pensez que votre Contenu a été copié d'une manière qui constitue une violation des droits d'auteur, le processus de signalement est détaillé dans les présentes conditions.<br>

                Veuillez également noter que ces Conditions intègrent notre Politique de confidentialité ainsi que d'autres conditions applicables à votre utilisation des Services et à votre Contenu. Enfin, ces conditions peuvent varier en fonction de l'endroit où vous habitez, mais vous devez quoi qu'il en soit avoir au moins 13 ans pour utiliser Z.</p>
        </div>
        <?php
        include 'partials/footer.php';
        (new Layout('PasX', ob_get_clean(), 'termsOfUse'))->show();
    }
}
?>
