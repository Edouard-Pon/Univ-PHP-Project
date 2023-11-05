<?php

namespace app\views\connections;

use app\views\layouts\Layout;
use app\views\partials\Footer;

class Recovery
{
    public function show(bool $verifiedEmail = null, string $email = null): void
    {
        ob_start();
?>
<div class="flex-container">
    <form method="POST" action="">
        <div class="logo"><img src="/assets/images/logoblanc.png" class="image" alt=""></div>

        <label for="email">Adresse Mail:</label>
        <input class="inputText" id="email" type="email" name="email" <?php if ($email !== null) { echo 'value="' . $email . '"'; echo 'readonly'; } ?> placeholder="Entrez votre adresse mail" autocomplete="off">

        <?php if ($verifiedEmail) { ?>
        <label for="password">Nouveau mot de passe:</label>
        <input class="inputText" id="password" type="password" name="password" autocomplete="off" placeholder="Entrez votre mot de passe">
        <?php } ?>
        <a href="/signup">Créer un compte</a>
        <input type="submit" name="recovery" value="Find account">
        <?php if (isset($_SESSION['errorMessage'])) { ?>
            <p id="errorMessage"> <?php echo $_SESSION['errorMessage'] ?></p>
        <?php unset($_SESSION['errorMessage']); } ?>
    </form>
</div>
<?php
echo (new Footer())->show();
        (new Layout('PasX - Recovery', ob_get_clean(), 'connection'))->show();
    }
}
?>
