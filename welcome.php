<?php   
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('location: login.php');
    exit();
}
$user_id = $_SESSION['user_id'] ?? "inconnu";
$username = $_SESSION['username'] ?? "non renseigné";
$email = $_SESSION['email'] ?? "pas d'e-mail"

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        Bienvenue <?= $username ?>
    </h1>
    <a href="login.php">Deconnexion</a>
</body>
</html>