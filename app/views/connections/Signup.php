<?php

namespace app\views\connections;
error_reporting(E_ERROR | E_PARSE);
use app\views\layouts\Layout;
use app\views\partials\Footer;

class Signup
{
    public function show(bool $emailVerification = null, string $email = null): void
    {
        ob_start();
?>
<div class="page-content">
    <div class="flex-container">
        <form method="POST" action="">
            <div class="logo"><img src="/assets/images/logoblanc.png" class="image" alt=""></div>

            <label for="email">Adresse Mail:</label>
            <input class="inputText" id="email" type="email" name="email" <?php if ($email !== null) { echo 'value="' . $email . '"'; echo 'readonly'; } ?> placeholder="Entrez votre adresse mail" autocomplete="off">

            <?php if (!$emailVerification) { ?>
            <label for="password">Mot de passe:</label>
            <input class="inputText" id="password" type="password" name="password" autocomplete="off" placeholder="Entrez votre mot de passe">

            <label for="username">Username:</label>
            <input class="inputText" id="username" type="text" name="username" autocomplete="off" placeholder="Entrez votre pseudo">

            <label for="nickname">Pseudo:</label>
            <input class="inputText" id="nickname" type="text" name="nickname" autocomplete="off" placeholder="Entrez votre surnom">

            <label for="user_phone">Téléphone:</label>
            <input class="inputText" type="tel" name="number" id="user_phone" inputmode="numeric" placeholder="Entrez votre numéro de téléphone" pattern="[0-9]{10}">

            <label for="user_country">Pays:</label>
            <select class="inputSelect" id="user_country" name="location">
                <option disabled selected>---Choisissez un pays---</option>
                <option value="France">France</option>
                <option value="Ukraine">Ukraine</option>
                <option value="Listembourg">Listembourg</option>
                <option value="Royaume-Unis">Royaume-Unis</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Zimbabwe">Zimbabwe</option>
                <option value="Mars">Mars</option>
                <option value="Aix-En-Provence">Aix-En-Provence</option>
                <option value="IUT">IUT</option>
            </select>
            <label for="user_sexe">Sexe:</label>
            <select class="inputSelect" id="user_sexe" name="gender">
                <option disabled selected>--Choisissez un sexe--</option>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
                <option value="Hélicoptère de combat">Hélicoptère de combat</option>
                <option value="Adaptateur USB">Adaptateur USB</option>
                <option value="Matraque téléscopique">Matraque téléscopique</option>
                <option value="Stroboscope lumineux">Stroboscope lumineux</option>
                <option value="Astronaute en perdition">Astronaute en perdition</option>
                <option value="Casque VR">Casque VR</option>
                <option value="Flaque de couleur">Flaque de couleur</option>
                <option value="Elexir de rage">Elexir de rage</option>
                <option value="Géant des collines">Géant des collines</option>
            </select>
            <?php } ?>
            <a href="/login">Déjà un compte?</a>
            <input type="submit" name="signup" value="Signup">
            <?php if (isset($_SESSION['errorMessage'])) { ?>
            <p id="errorMessage"> <?php echo $_SESSION['errorMessage'] ?></p>
            <?php unset($_SESSION['errorMessage']); } ?>
        </form>
    </div>
</div>
<?php
echo (new Footer())->show();
        (new Layout('PasX - Sign Up', ob_get_clean(), 'connection'))->show();
    }
}
?>
