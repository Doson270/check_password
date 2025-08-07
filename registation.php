<?php
$validmessage = [];
require_once "config/database.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars(trim($_POST["username"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"]?? ""));
    $password = $_POST["password"] ?? "";
    $confirmpassword = $_POST["confirmpassword"] ?? "";


if (empty($username)) {
    $validmessage[] = "verifier les informations";
}
    elseif (strlen($username) < 5) {
    $validmessage[] = "mot de passe trop court";
    }
    elseif (strlen($username) > 55) { 
    $validmessage[] = "Maximum 55 caractere";
    }
    if (empty($email)) {
        $validmessage[] = "Veuillez remplir votre E-mail";
    }
    elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
        $validmessage[] = "E-mail incorrecte";
    }
    if (empty($password)) {
        $validmessage[] = "Veuillez saisir un mot de passe valide";
    }
    elseif (strlen($password)< 10){
        $validmessage[] = "Mot de passe trop court";

    }
    elseif ($password !== $confirmpassword){
        $validmessage[] = "Les mots de passes de correspendent pas";
    }

$errors = []; 
if (empty($errors)) {
    $pdo = dbConnexion();


// verifier si l'email est utilisé ou non 
$checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = ?");

$checkEmail->execute([$email]);
// une fonction pour verifier si je recupere quelque chose
if ($checkEmail->rowcount() > 0){ 
    $errors[] = "email deja validé";
}else{
    // dans le cas ou tout va bien 
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
// foncgion qui permet d'jouter une users a ma bdd
    $insertUsers = $pdo->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)");
    $insertUsers->execute([$username, $email, $hashPassword]);

    echo "Utilisateur ajouté avec succés";

}}}
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

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="confirmpassword">Confirm Password</label>
            <input type="password" name="confirmpassword" id="confirmpassword">

            <input type="submit" value="valider">
        </form>
            <?php foreach ($validmessage as $message){?>
            <span class="span"><?php echo $message ?></span>
            <?php } ?>

        
    </section>
</body>
</html>
<?php
