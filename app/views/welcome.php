<?php
class WelcomeView
{
    public function show(): void
    {
        ob_start();
?>
<div class="page-content">
    <div class="flex-container">
        <div class="logo"><img src="assets/images/logoblanc.png" class="image" alt=""></div>
        <div class="interface">
            <p class="bigtext"><b>Nous aussi on <br>peut le faire</b></p>
            <p class="medtext"><b>Rejoignez dès aujourd'hui</b></p>
            <button class="signup" onclick="window.location.href='/signup'"><b>Créer un compte</b></button>
            <p class="minitext">En vous inscrivant, vous acceptez les conditions d'utilisation et de confidentialité<br> Politique incluant l'utilisation des cookies.</p>
            <p class="medtext"><b>Déja un compte?</b></p>
            <button class="signin" onclick="window.location.href='/login'"><b>Se connecter</b></button>
        </div>
    </div>
</div>
<?php
include 'partials/footer.php';
        (new Layout('PasX', ob_get_clean(), 'welcome'))->show();
    }
}
?>
