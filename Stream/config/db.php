<?php
$host = 'localhost';
$dbname = 'Bibliothèque';
$user = 'postgres';
$password = 'code123';

// Créer une chaîne de connexion
$dsn = "pgsql:host=$host;dbname=$dbname";

// Se connecter à la base de données
try {
    $database = new PDO($dsn, $user, $password);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>