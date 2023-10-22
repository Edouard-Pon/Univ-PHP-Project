<?php

namespace app\views;

class WelcomeView
{
    public function show(): void
    {
        ob_start();
?>
<div class="flex-container">
    <div class="logo"><img src="assets/images/logoblanc.png" class="image" alt=""></div>
    <div class="interface">
        <p class="title">Nous aussi on <br>peut le faire</p>
        <p class="subtitle">Rejoignez dès aujourd'hui</p>
        <a class="btn signup" href='/signup'>Créer un compte</a>
        <p class="text">En vous inscrivant, vous acceptez les conditions d'utilisation et de confidentialité<br>Politique incluant l'utilisation des cookies.</p>
        <p class="subtitle">Déja un compte?</p>
        <a class="btn login" href='/login'">Se connecter</a>
    </div>
</div>
<?php
include 'partials/footer.php';
        (new Layout('PasX', ob_get_clean(), 'welcome'))->show();
    }
}
?>
