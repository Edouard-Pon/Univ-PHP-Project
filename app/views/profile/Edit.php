<?php

namespace app\views\profile;

class Edit
{
    public function show(): string
    {
        ob_start();
?>
<div>
    <h1>Profile Settings</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="username" value="<?= $_SESSION['username'] ?>">
        <input type="file" id="image-input" name="image" accept="image/*" onchange="loadImage()">

        <input type="hidden" name="crop-x" id="crop-x">
        <input type="hidden" name="crop-y" id="crop-y">
        <input type="hidden" name="crop-w" id="crop-w">
        <input type="hidden" name="image-w" id="image-w">
        <input type="hidden" name="image-h" id="image-h">

        <button type="submit" name="save-profile">Save</button>
    </form>
    <div>
        <div id="image-con">
            <img id="image" alt="Image">
            <div id="crop-box"></div>
        </div>
        <button id="zoom-in">Zoom In</button>
        <button id="zoom-out">Zoom Out</button>

        <script defer src="/assets/scripts/cropper.js"></script>
    </div>
</div>
<?php
        return ob_get_clean();
    }
}
?>
