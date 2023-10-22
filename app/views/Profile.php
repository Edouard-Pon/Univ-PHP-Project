<?php

namespace app\views;

class ProfileView
{
    public function show($data, $posts): void
    {
        ob_start();
        ?>

        <html>
        <head>
            <title>User Profile</title>
        </head>
        <body>
        <h1>User Profile</h1>

        <!-- Display user information here -->
        <p>Name: <?php echo $data['name']; ?></p>
        <p>Email: <?php echo $data['email']; ?></p>
        <p>Phone: <?php echo $data['phone']; ?></p>
        <p>Location: <?php echo $data['location']; ?></p>
        <p>Gender: <?php echo $data['gender']; ?></p>
        <p>Last Login: <?php echo $data['lastco']; ?></p>

        <h2>Profile picture</h2>
        <img src="<?= $data['profile_picture'] ?>" alt="Image">

        <!-- Provide an option to update user information -->
        <!-- <a href="update_profile.php">Update Profile</a> -->

        <h3>Your posts</h3>
        <div id="posts">
            <?php
            foreach ($posts as $post) {
                include('posts/post.php');
                echo "<button>Delete post</button>";
            }
            ?>
        </div>

        <!-- Add a logout link if needed -->
        <a href="/logout">Logout</a>
        </body>
        </html>

        <?php
        (new Layout('PasX - Profil', ob_get_clean(), 'profil'))->show();
    }
}
?>
