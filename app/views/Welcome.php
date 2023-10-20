<?php

namespace app\views;

class WelcomeView
{
    public function show(): void
    {
        ob_start();
?>
<div id="body">
    <img src="assets/images/logoblanc.png" class="image" alt="Logo Z blanc" width="400">
    <div id="interface">
        <p id="bigtext"><b>Nous aussi on <br> peut le faire</b></p>
        <p id="medtext"><b>Rejoignez dès aujourd'hui</b></p>
        <button id="signup" onclick="window.location.href='/signup'"><b>Créer un compte</b></button>
        <p id="minitext">En vous inscrivant, vous acceptez les conditions d'utilisation et de confidentialité<br> Politique incluant <a href="/termsofuse"> l'utilisation des cookies.</a></p>
        <p id="medtext"><b>Déja un compte?</b></p>
        <button id="signin" onclick="window.location.href='/login'"><b>Se connecter</b></button>
    </div>
</div>
<?php
include 'partials/footer.php';
        (new Layout('PasX', ob_get_clean(), 'welcome'))->show();
    }
}
?>
