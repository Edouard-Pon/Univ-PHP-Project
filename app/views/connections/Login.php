<?php

namespace app\views\connections;

use app\views\layouts\Layout;
use app\views\partials\Footer;

class Login
{
    public function show(): void
    {
        ob_start();
?>
<div class="flex-container">
    <form method="POST" action="">
        <div class="logo"><img src="assets/images/logoblanc.png" class="image" alt=""></div>

        <label for="username">Nom d'utilisateur:</label>
        <input class="inputText" id="username" type="text" name="username" autocomplete="off" placeholder="Entrez votre nom d'utilisateur">

        <label for="password">Mot de passe:</label>
        <input class="inputText" type="password" name="password" autocomplete="off" placeholder="Entrez votre mot de passe">

        <a href="/signup">Créer un compte</a>
        <input type="submit" name="login" id="submitButton">
        <?php if (isset($_SESSION['errorMessage'])) { ?>
        <p id="errorMessage"> <?php echo $_SESSION['errorMessage'] ?></p>
        <?php unset($_SESSION['errorMessage']); } ?>
    </form>
</div>
<?php
echo (new Footer())->show();
        (new Layout('PasX - Login', ob_get_clean(), 'connection'))->show();
    }
}
?>
