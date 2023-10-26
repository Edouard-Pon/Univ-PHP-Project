<?php

namespace app\views\partials;

class Footer
{
    public function show(): string
    {
        ob_start();
?>
<footer>
    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">À propos</a>
    <a href="https://www.univ-amu.fr/">IUT Aix-Marseille</a>
    <a href="https://github.com/Edouard-Pon/Univ-PHP-Project">Développeurs</a>
    <a>© 2023 Notre Equipe</a>
</footer>
<?php
        return ob_get_clean();
    }
}
?>


