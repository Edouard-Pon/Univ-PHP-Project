<?php

namespace app\views;

class ProfileView
{
    public function show(): void
    {
        ob_start();
        ?>

        <?php
        (new Layout('PasX - Profil', ob_get_clean(), 'profil'))->show();
    }
}
?>
