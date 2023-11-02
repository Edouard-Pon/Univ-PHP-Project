<?php

namespace app\views\profile;

class Edit
{
    public function show(): string
    {
        ob_start();
?>
<a id="close" href="/profile"></a>
<div class="popup" id="editProfile">
    <h1>Profile Settings</h1>
    <form method="POST" action="/profile" enctype="multipart/form-data">
        <input type="text" id="username" name="username" value="<?= $_SESSION['username'] ?>">
        <label class="btn btn-primary uploadImgBtn" for="image-input">Profile Picture</label>
        <input type="file" id="image-input" name="image" accept="image/*" onchange="loadImage()">

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
