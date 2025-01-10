<?php
$host = 'localhost';
$dbname = 'Bibliothèque';
$user = 'postgres';
$password = 'code123';

// Créer une chaîne de connexion
$dsn = "pgsql:host=$host;dbname=$dbname";

// Se connecter à la base de données
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>




    <div class="container">

        <div class="bienvenue">
            <nav>
                <div class="titre">STREAM</div>
                <div class="search">
                    <input type="search" name="search" id="search" placeholder="Rechercher un livre">
                    <svg class="icon-search" height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 339.921 339.921" xml:space="preserve">
                        <g>
                            <path style="fill:#283069;" d="M335.165,292.071l-81.385-84.077c-5.836-6.032-13.13-8.447-16.29-5.363
            c-3.171,3.062-10.47,0.653-16.306-5.379l-1.164-1.207c36.425-47.907,32.89-116.499-10.851-160.24
            c-47.739-47.739-125.142-47.739-172.875,0c-47.739,47.739-47.739,125.131,0,172.87c44.486,44.492,114.699,47.472,162.704,9.045
            l0.511,0.533c5.825,6.032,7.995,13.402,4.814,16.469c-3.166,3.068-1.012,10.443,4.83,16.464l81.341,84.11
            c5.836,6.016,15.452,6.195,21.49,0.354l22.828-22.088C340.827,307.735,340.99,298.125,335.165,292.071z M182.306,181.81
            c-32.852,32.857-86.312,32.857-119.159,0.011c-32.852-32.852-32.847-86.318,0-119.164c32.847-32.852,86.307-32.847,119.148,0.005
            C215.152,95.509,215.152,148.964,182.306,181.81z" />
                        </g>
                    </svg>
                    <button type="submit" id="recherche">Rechercher</button>
                </div>
                <div style="display: flex;width:fit-content;;align-items:center;justify-content:right;padding: 0 10px 0 10px;font-weight: 700;">
                    <ul>
                        <li><a href="">Ajouter un Livre</a></li>
                        <li><a href="informations.php">À Propos</a></li>
                        <li><a href="mailto:timotheeklaus@gmail.com">Contactez-nous</a></li>
                    </ul>
                </div>
            </nav>
            <div class="text">
                <h1>Bienvenue dans notre bibliothèque</h1>
                <p style="width: 50vw;margin: 0 auto;font-family: serif;font-size: .8em;">Plongez dans un océan de connaissance et d'histoires passionnantes<br>Découvrez notre connexion de livres soigneusement selectionnés et enrichissez votre esprits<br>
                    Rejoignez-nous dans cette aventure littéraire et laissez chaque page tournée vous emmener vers de nouveaux horizons</p>
            </div>
        </div>
        <h1>Disponibles</h1>
        <div class="disponible">

            <div style="display: flex;justify-content:center;align-items: center; gap : 25px;">
                <!-- Afficher les livres -->


                <?php
                // Récupérer tous les livres de la bibliothèque

                $reqLivre = $pdo->query('SELECT * FROM livre');
                $livres = $reqLivre->fetchAll(PDO::FETCH_ASSOC);
                $reqAuteur = $pdo->query('SELECT * FROM auteur');
                foreach ($livres as $livre) {
                    echo '<div class="card">
                        <div class="img-livre"><img src="' . $livre['image_url'] . '" alt=""></div>
                        <div class="content">
                
                        <h2>' . $livre['titre_livre'] . '</h2>';
                    $idAuteur = $livre['id_auteur'];
                    $reqAuteur = $pdo->prepare('SELECT nom_auteur,prenom_auteur FROM Auteur WHERE id_auteur = ?');
                    $reqAuteur->execute(array($idAuteur));
                    $idAuteur = $reqAuteur->fetch(PDO::FETCH_ASSOC);
                    while ($idAuteur) {
                        $nomAuteur = $idAuteur['nom_auteur'] . ' ' . $idAuteur['prenom_auteur'];
                        $idAuteur = $reqAuteur->fetch(PDO::FETCH_ASSOC);
                    }
                    $idAuteur = $livre['id_auteur'];
                    $idCategorie = $livre['id_categorie'];

                    $reqAuteur = $pdo->prepare('SELECT nom_auteur, prenom_auteur FROM Auteur WHERE id_auteur = ?');
                    $reqAuteur->execute(array($idAuteur));
                    $auteur = $reqAuteur->fetch(PDO::FETCH_ASSOC);

                    $reqCategorie = $pdo->prepare('SELECT libelle_categorie FROM categorie WHERE id_categorie = ?');
                    $reqCategorie->execute(array($idCategorie));
                    $categorie = $reqCategorie->fetch(PDO::FETCH_ASSOC);

                    if ($auteur) {
                        $nomAuteur = $auteur['nom_auteur'] . ' ' . $auteur['prenom_auteur'];
                    }

                    if ($categorie) {
                        $nomCategorie = $categorie['libelle_categorie'];
                    }

                    echo '<p><u>Auteur :</u> ' . $nomAuteur . '<br><u>Année :</u> ' . $livre['annee'] . '<br><u>Catégorie :</u> '.$nomCategorie.'</p>
                                <p class="description"><u>Description :</u> ' . $livre['description'] . '</p>
                                <div class="buttons">
                                    <button id="read">Lire</button>
                                    <svg width="5vh" height="5vh" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12ZM12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V12.1893L14.4697 10.4697C14.7626 10.1768 15.2374 10.1768 15.5303 10.4697C15.8232 10.7626 15.8232 11.2374 15.5303 11.5303L12.5303 14.5303C12.3897 14.671 12.1989 14.75 12 14.75C11.8011 14.75 11.6103 14.671 11.4697 14.5303L8.46967 11.5303C8.17678 11.2374 8.17678 10.7626 8.46967 10.4697C8.76256 10.1768 9.23744 10.1768 9.53033 10.4697L11.25 12.1893V7C11.25 6.58579 11.5858 6.25 12 6.25ZM8 16.25C7.58579 16.25 7.25 16.5858 7.25 17C7.25 17.4142 7.58579 17.75 8 17.75H16C16.4142 17.75 16.75 17.4142 16.75 17C16.75 16.5858 16.4142 16.25 16 16.25H8Z" fill="#1C274C" />
                                    </svg>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
        <h1>Nouveautés</h1>
        <div class="nouveautés">

            <div style="display: flex;justify-content:center;align-items: center; gap : 25px;">
                <!-- Afficher les livres -->


                <?php
                // Récupérer tous les livres de la bibliothèque

                $reqLivre = $pdo->query('SELECT * FROM livre WHERE annee >= 2024');
                $livres = $reqLivre->fetchAll(PDO::FETCH_ASSOC);

                $reqAuteur = $pdo->query('SELECT * FROM auteur');
                foreach ($livres as $livre) {
                    echo '<div class="card">
                        <div class="img-livre"><img src="' . $livre['image_url'] . '" alt=""></div>
                        <div class="content">
                
                        <h2>' . $livre['titre_livre'] . '</h2>';
                    $idAuteur = $livre['id_auteur'];
                    $idCategorie = $livre['id_categorie'];

                    $reqAuteur = $pdo->prepare('SELECT nom_auteur, prenom_auteur FROM Auteur WHERE id_auteur = ?');
                    $reqAuteur->execute(array($idAuteur));
                    $auteur = $reqAuteur->fetch(PDO::FETCH_ASSOC);

                    $reqCategorie = $pdo->prepare('SELECT libelle_categorie FROM categorie WHERE id_categorie = ?');
                    $reqCategorie->execute(array($idCategorie));
                    $categorie = $reqCategorie->fetch(PDO::FETCH_ASSOC);

                    if ($auteur) {
                        $nomAuteur = $auteur['nom_auteur'] . ' ' . $auteur['prenom_auteur'];
                    }

                    if ($categorie) {
                        $nomCategorie = $categorie['libelle_categorie'];
                    }

                    echo '<p><u>Auteur :</u> ' . $nomAuteur . '<br><u>Année :</u> ' . $livre['annee'] . '<br><u>Catégorie :</u> '.$nomCategorie.'</p>
                                <p class="description"><u>Description :</u> ' . $livre['description'] . '</p>
                                <div class="buttons">
                                    <button id="read">Lire</button>
                                    <svg width="5vh" height="5vh" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12ZM12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V12.1893L14.4697 10.4697C14.7626 10.1768 15.2374 10.1768 15.5303 10.4697C15.8232 10.7626 15.8232 11.2374 15.5303 11.5303L12.5303 14.5303C12.3897 14.671 12.1989 14.75 12 14.75C11.8011 14.75 11.6103 14.671 11.4697 14.5303L8.46967 11.5303C8.17678 11.2374 8.17678 10.7626 8.46967 10.4697C8.76256 10.1768 9.23744 10.1768 9.53033 10.4697L11.25 12.1893V7C11.25 6.58579 11.5858 6.25 12 6.25ZM8 16.25C7.58579 16.25 7.25 16.5858 7.25 17C7.25 17.4142 7.58579 17.75 8 17.75H16C16.4142 17.75 16.75 17.4142 16.75 17C16.75 16.5858 16.4142 16.25 16 16.25H8Z" fill="#1C274C" />
                                    </svg>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>


            <div class="filtre">
                <h1>Trier par : </h1>
                <div>

                </div>
            </div>
        </div>


        <!-- Afficher les livres -->



</body>

</html>