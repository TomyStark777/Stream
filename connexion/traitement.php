<?php
try {
    $database = new PDO('mysql:host=localhost;dbname=stream', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$req=$database->prepare('SELECT keyword FROM utilisateurs WHERE email=?');
$email = $_POST['email'];
$password = $_POST['keyword'];
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$req->execute(array($email));

while($dbKey = $req->fetch()){
    $code = $dbKey['keyword'];
}




if ($password === $code) {
    // Mot de passe correct, redirection vers index.php 
    header('Location: ../Accueil/index.php');
    exit();
} else { // Mot de passe incorrect, redirection vers le formulaire avec un message d'erreur 
    header('Location: ../Connexion/connexion.php?error=incorrect');
    exit();
}
?>

    

