<?php   
session_start(); // Démarre la session pour accéder aux variables de session

// Vérifie si l'utilisateur est connecté :
// si la clé 'login' n'est pas définie ou si elle n'est pas à true, alors on redirige vers la page de login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('location: login.php'); // Redirection vers la page de connexion
    exit(); // Stoppe l'exécution du script
}

// Récupération des données utilisateur depuis la session (avec valeurs par défaut si absentes)
$user_id = $_SESSION['user_id'] ?? "inconnu"; // ID de l'utilisateur
$username = $_SESSION['username'] ?? "non renseigné"; // Nom d'utilisateur
$email = $_SESSION['email'] ?? "pas d'e-mail"; // Adresse email

// Vérifie si le paramètre 'logout' est présent dans l'URL et s'il est égal à '1'
if (isset($_GET['logout']) && $_GET['logout'] === '1') {
    $_SESSION = [];           // Vide toutes les variables de session
    session_destroy();        // Détruit complètement la session côté serveur
    // s'il est deconnecté on le rev=nvoie vers la page login 
    header('location: login.php');

    exit;

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Encodage des caractères -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
    <title>Document</title>
</head>
<body>
    <h1>
        Bienvenue <?= $username ?> <!-- Affiche le nom d'utilisateur récupéré depuis la session -->
    </h1>

    <a href="?logout=1">Deconnexion</a> <!-- Lien vers la page de connexion (à modifier pour une vraie déconnexion) -->
</body>
</html>
