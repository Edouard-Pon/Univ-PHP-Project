<?php
$folder = '../../public/posts'; // Replace with the path to your folder

$files = scandir($folder);

foreach ($files as $file) {
    $file_info = pathinfo($folder . '/' . $file);
    $file_extension = strtolower($file_info['extension']);
    echo '<head>
    <link rel="stylesheet" href="../../public/assets/styles/connection.css"">
    </head>';
    // Check if the file is an image (you can add more image extensions as needed)
    if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
        echo  $file_info['filename'].'<br>';
        echo '<img src="' . $folder . '/' . $file . '" alt="' . $file_info['filename'] . '"><br><br>';
    }
}
?>
</body>
</html>