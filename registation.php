<?php
$validmessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST["name"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"]?? ""));
    $password = $_POST["password"] ?? "";
    $confirmpassword = $_POST["confirmpassword"] ?? "";


if (empty($name)) {
    $validmessage = "verifier les informations";
}
    elseif (strlen($name) < 5) {
    $validmessage = "mot de passe trop court";
    }
    elseif (strlen($name) > 55) { 
    $validmessage = "Maximum 55 caractere";
    }
    if (empty($email)) {
        $validmessage = "Veuillez remplir votre E-mail";
    }
    elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
        $validmessage = "E-mail incorrecte";
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
            <label for="name">Name</label>
            <input type="name" name="name" id="name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm password">Confirm Password</label>
            <input type="password" name="confirmpassword" id="confirmpassword">

            <input type="submit" value="valider">

            <span class="span"><?= $validmessage ?></span>

        </form>
    </section>
</body>
</html>