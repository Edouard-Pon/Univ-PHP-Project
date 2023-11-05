<?php

namespace app\views\profile;
error_reporting(E_ERROR | E_PARSE);
class Edit
{
    public function show($user): string
    {
        ob_start();
?>
<a id="close" href="/profile"></a>
<div class="popup scroll-container" id="editProfile">
    <h1>Profile Settings</h1>
    <form method="POST" action="/profile" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-item">
                <label for="username">Username:</label>
                <input class="inputText" type="text" id="username" name="username" value="<?= $_SESSION['username'] ?>">
            </div>

            <div class="form-item">
                <label for="nickname">Pseudo:</label>
                <input class="inputText" id="nickname" type="text" name="nickname" autocomplete="off" value="<?= $user['nickname'] ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-item">
                <label for="user_country">Pays:</label>
                <select class="inputSelect" id="user_country" name="location">
                    <option disabled selected value="<?= $user['location'] ?>"><?= $user['location'] ?></option>
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
            </div>

            <div class="form-item">
                <label for="user_sexe">Sexe:</label>
                <select class="inputSelect" id="user_sexe" name="gender">
                    <option disabled selected value="<?= $user['gender'] ?>"><?= $user['gender'] ?></option>
                    <option value="M">Homme</option>
                    <option value="F">Femme</option>
                    <option value="Helico_de_combat">Hélicoptère de combat</option>
                    <option value="Adaptateur_Usb">Adaptateur USB</option>
                    <option value="Matraque_Telescopique">Matraque téléscopique</option>
                    <option value="Stroboscope_Lumineux">Stroboscope lumineux</option>
                    <option value="Astronaute_En_Perdition">Astronaute en perdition</option>
                    <option value="Casque_VR">Casque VR</option>
                    <option value="Flaque_De_Couleur">Flaque de couleur</option>
                    <option value="Elexir_De_Rage">Elexir de rage</option>
                    <option value="Géant_Des_Collines">Géant des collines</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-item">
                <label class="btn btn-primary uploadImgBtn" for="image-input">Profile Picture</label>
                <input type="file" id="image-input" name="image" accept="image/*" onchange="loadImage()">
            </div>
        </div>

        <input type="hidden" name="crop-x" id="crop-x">
        <input type="hidden" name="crop-y" id="crop-y">
        <input type="hidden" name="crop-w" id="crop-w">
        <input type="hidden" name="image-w" id="image-w">
        <input type="hidden" name="image-h" id="image-h">

        <div class="buttons">
            <a class="btn btn-primary" href="/profile">Cancel</a>
            <button class="btn btn-danger" type="submit" name="save-profile">Save</button>
        </div>
    </form>
    <div id="cropper-window">
        <div id="image-con">
            <img id="image" alt="Image">
            <div id="crop-box"></div>
        </div>
        <div class="buttons">
            <button class="btn btn-primary" id="zoom-in">Zoom In</button>
            <button class="btn btn-primary" id="zoom-out">Zoom Out</button>
        </div>

        <script defer src="/assets/scripts/cropper.js"></script>
    </div>
</div>
<?php
        return ob_get_clean();
    }
}
?>
