<?php

include '../config/db.php';

// Ajouter un livre
if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
    $isbn = $_POST['isbn'];
    $langue = $_POST['langue'];
    $description = $_POST['description'];
    $id_auteur = $_POST['id_auteur'];
    $id_categorie = $_POST['id_categorie'];
    $download_url = $_POST['download_url'];
    $image_url = $_POST['image_url'];

    // Vérifier si l'auteur existe
    $auteur_check = $conn->query("SELECT id_auteur FROM Auteur WHERE id_auteur = $id_auteur");
    if ($auteur_check->num_rows == 0) {
        // Ajouter l'auteur s'il n'existe pas
        $nom_auteur = $_POST['nom_auteur'];
        $prenom_auteur = $_POST['prenom_auteur'];
        $date_naiss = $_POST['date_naiss'];
        $nationalite = $_POST['nationalite'];
        $conn->query("INSERT INTO Auteur (id_auteur, nom_auteur, prenom_auteur, date_naiss_auteur, nationalite_auteur)
                      VALUES ($id_auteur, '$nom_auteur', '$prenom_auteur', '$date_naiss', '$nationalite')");
    }

    // Ajouter le livre
    $conn->query("INSERT INTO Livre (id_livre, titre_livre, annee, isbn, langue_livre, id_auteur, id_categorie, description, download_url, image_url)
                  VALUES (NULL, '$titre', $annee, $isbn, '$langue', $id_auteur, $id_categorie, '$description', '$download_url', '$image_url')");
}

// Modifier un livre
if (isset($_POST['modifier'])) {
    $id_livre = $_POST['id_livre'];
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
    $isbn = $_POST['isbn'];
    $langue = $_POST['langue'];
    $description = $_POST['description'];
    $id_categorie = $_POST['id_categorie'];
    $download_url = $_POST['download_url'];
    $image_url = $_POST['image_url'];

    $conn->query("UPDATE Livre SET 
                  titre_livre = '$titre', 
                  annee = $annee, 
                  isbn = $isbn, 
                  langue_livre = '$langue', 
                  description = '$description', 
                  id_categorie = $id_categorie, 
                  download_url = '$download_url', 
                  image_url = '$image_url'
                  WHERE id_livre = $id_livre");
}

// Supprimer un livre
if (isset($_POST['supprimer'])) {
    $id_livre = $_POST['id_livre'];
    $conn->query("DELETE FROM Livre WHERE id_livre = $id_livre");
}
?>

<!-- Interface utilisateur -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Livres</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        h1,
        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 50vw;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        input,
        textarea,
        button {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        label {
            font-weight: bold;
        }

        @media (max-width: 768px) {
            form {
                padding: 15px;
            }

            input,
            textarea,
            button {
                padding: 8px;
            }

            h1,
            h2 {
                font-size: 1.5em;
            }
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>Gestion des Livres</h1>

    <!-- Formulaire pour ajouter un livre -->
    <form method="post" action="">
        <h2>Ajouter un Livre</h2>
        <input type="text" name="titre" placeholder="Titre" required>
        <input type="number" name="annee" placeholder="Année" required>
        <input type="number" name="isbn" placeholder="ISBN" required>
        <input type="text" name="langue" placeholder="Langue" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="id_auteur" placeholder="ID Auteur" required>
        <input type="text" name="nom_auteur" placeholder="Nom Auteur (si nouveau)">
        <input type="text" name="prenom_auteur" placeholder="Prénom Auteur (si nouveau)">
        <input type="date" name="date_naiss" placeholder="Date de Naissance (si nouveau)">
        <input type="text" name="nationalite" placeholder="Nationalité (si nouveau)">
        <input type="number" name="id_categorie" placeholder="ID Catégorie" required>
        <input type="text" name="download_url" placeholder="URL de Téléchargement">
        <input type="text" name="image_url" placeholder="URL de l'Image">
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <!-- Formulaire pour modifier un livre -->
    <form method="post" action="">
        <h2>Modifier un Livre</h2>
        <input type="number" name="id_livre" placeholder="ID Livre" required>
        <input type="text" name="titre" placeholder="Titre" required>
        <input type="number" name="annee" placeholder="Année" required>
        <input type="number" name="isbn" placeholder="ISBN" required>
        <input type="text" name="langue" placeholder="Langue" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="id_categorie" placeholder="ID Catégorie" required>
        <input type="text" name="download_url" placeholder="URL de Téléchargement">
        <input type="text" name="image_url" placeholder="URL de l'Image">
        <button type="submit" name="modifier">Modifier</button>
    </form>

    <!-- Formulaire pour supprimer un livre -->
    <form method="post" action="">
        <h2>Supprimer un Livre</h2>
        <input type="number" name="id_livre" placeholder="ID Livre" required>
        <button type="submit" name="supprimer">Supprimer</button>
    </form>

    <?php
    // Supprimer un utilisateur
    if (isset($_POST['supprimer_utilisateur'])) {
        $id_abonnee = $_POST['id_abonnee'];
        $conn->query("DELETE FROM abonnee WHERE id_abonnee = $id_abonnee");
    }
    ?>

    <!-- Formulaire pour supprimer un utilisateur -->
    <form method="post" action="">
        <h2>Supprimer un Utilisateur</h2>
        <label for="id_abonnee">ID Abonné :</label>
        <input type="number" id="id_abonnee" name="id_abonnee" placeholder="ID Utilisateur" required>
        <button type="submit" name="supprimer_utilisateur">Supprimer</button>
    </form>

</body>

</html>