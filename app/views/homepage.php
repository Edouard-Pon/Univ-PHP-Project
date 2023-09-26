<?php
session_start();
if (!isset($_SESSION['password'])){
    header ('Location: connection.php');
    exit;
}
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
echo $_SESSION ['name'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
</head>
<body>
    <a href="disconnection.php">
        <button>Se déconnecter</button>
    </a>
</body> 
</html>
