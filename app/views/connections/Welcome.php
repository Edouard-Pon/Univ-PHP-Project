<?php

namespace app\views\connections;
error_reporting(E_ERROR | E_PARSE);
use app\views\layouts\Layout;
use app\views\partials\Footer;

class Welcome
{
    public function show(): void
    {
        ob_start();
?>
<div class="flex-container">
    <div class="logo"><img src="/assets/images/logoblanc.png" class="image" alt=""></div>
    <div class="interface">
        <p class="title">Nous aussi on <br>peut le faire</p>
        <p class="subtitle">Rejoignez dès aujourd'hui</p>
        <button class="signup" onclick="location.href = '/signup'">Créer un compte</button>
        <p class="text">En vous inscrivant, vous acceptez les conditions d'utilisation et de confidentialité<br>Politique incluant l'utilisation des cookies.</p>
        <p class="subtitle">Déja un compte?</p>
        <button class="login" onclick="location.href = 'login'">Se connecter</button>
    </div>
</div>
<?php
echo (new Footer())->show();
        (new Layout('PasX', ob_get_clean(), 'welcome'))->show();
    }
}
?>
