<?php
    session_start();
    try {
        $database = new PDO('mysql:host=localhost;dbname=stream', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $reponse = $database->query('SELECT * FROM utilisateurs');
    while($user = $reponse->fetch()){
        echo "--- User ".$user['id']."<br>Nom : ".$user['nom']."<br>";
        echo "Prénoms : ".$user['prenom']."<br>";
        echo "E-mail : ".$user['email']."<br>";
        echo "Mot de passe : ".$user['keyword']."<br><br>";

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <p>Bienvenue sur ma page</p>

</body>
</html>