<?php
// logique de connexion a la BBD

// information pour ce connecter
// l'endroit ou est ma BDD
$host = "localhost";
// le nom de la BDD
$dbname = "users_db";
// identifiant de connection
$username = "root";
// mdp de connexion
$password = "";
// port
$port = 3306;
// encodage
$charset = "utf8mb4";

// fonction qui creer et renvoie une connexion a la BDD
function dbConnexion() {
// transforme mes variables en global (accessible partout)
    global $host, $dbname, $username, $password, $port, $charset;
// je creer un try et un catch pour pouvoir tester ma ligne de code 
// qui contient mes information pour pouvoir me connecter a ma BDD 
// et si elle ne fonctionne pas on peut renvoyer une ligne de code sur pour pas que sa plant
    try {
        // mes parametre de connexion
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
        // je creer mon objet de connexion
        // Je creer un objet "pdo = newpdo" et je lui injecte les information
        //  que je souhhaite et je lui modifie un attribut avec set attribut
        $pdo = new PDO($dsn, $username, $password)
        // comment recuperer les données
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // comment me renvoyer les données
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        // une fois que la connexion est effectué il me renvoie ma connexion
        return $pdo;
// le catch va gerer mes erreurs
    } catch (PDOExeption $e) {
        // si un probleme est detecté on dit d'arreter la lecture du code avec die 
        // et de me renvoyer l'erreur qui ce trouve dans $e
        die("Error 404". $e-> etMessage());
    }   
}
