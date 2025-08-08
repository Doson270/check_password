<?php
require_once "config/database.php";
session_start();
$message = "";
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST["username"] ?? ""));
    $password = $_POST["password"] ?? "";

    if (empty($username)) {
        $errors[] = "veillez remplir votre username";
    }
    if (empty($password)) {
        $errors[] = "veillez remplir votre mot de passe";
    }

    // Une condition qui dit que si erreur est vide alors on ce connecte a la BDD

    if (empty($errors)) {
        try { 
        // appelle de la fonction de connexion a la db 
        $pdo = dbconnexion();
        // prepare une requete sql username dynamique 
        $sql = "SELECT * FROM users WHERE username = ?";
        // stock ma request preparée 
        $request = $pdo->prepare($sql);
        // execute la requete en lui passant en parametre l'username dynamique 
        $request->execute([$username]);
        // recuperation des données 
        $user = $request->fetch();
    
    // ensuite on recupere le password et on verifie sil est juste
    if ($user) {
        if (password_verify($password, $user["password"])) {
            // recuperation de l'id de mon user 
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["user"] = $user["email"];
            $_SESSION["login"] = true;

            $message = "Bienvenue". htmlspecialchars($user['username']);
            header("location:welcome.php");
            exit();
        
    }else {
            $errors[] = "Compte introuvable";
        }
    } else {
            $errors[] = "Compte introuvable";
        }
    }catch (PDOExceptionv $e) {
    $errors[] = "nous avons des probleme" . $e->getmessage();
    }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
                <form action="" method="POST">
        
            <label for="username">Name</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="valider">

            <a href="registation.php">Je n'ai pas de compte</a>
            <?php
            if (!empty($errors)) {
            foreach($errors as $error) {
                echo $error;
            }
        }
        ?>
        </form>
    </section>
</body>
</html>