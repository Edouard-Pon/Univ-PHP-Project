<?php
class ProfilView
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
