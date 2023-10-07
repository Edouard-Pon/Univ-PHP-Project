<?php
class HomeView
{
    public function show($data, $posts): void
    {
        ob_start();
        ?>
        <!--<p>-->
        <!--    Home Page WIP<br>-->
        <!--    You are logged in as --><?php //echo $data['name'] ?><!--<br>-->
        <!--    Email: --><?php //echo $data['email'] ?>
        <!--    Number: --><?php //echo $data['phone'] ?>
        <!--    Location: --><?php //echo $data['location'] ?>
        <!--    Gender: --><?php //echo $data['gender'] ?>
        <!--    Admin Status: --><?php //echo $data['admin'] ?>
        <!--    Last connection: --><?php //echo $data['lastco'] ?>
        <!--</p>-->
        <div id="right_informations">
            photo de profil du mec
            <?php echo $data['name']?>
            <?php include('partials/navbar.php')?>
            <a href="disconnection.php">
                <button>Disconnect</button>
            </a>
        </div>
        <?php
        foreach ($posts as $post) {
            include('posts/post.php');
        }
        (new Layout('PasX - Home', ob_get_clean(), 'home'))->show();
    }
}
?>
