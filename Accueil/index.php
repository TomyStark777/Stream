<?php
include "../config/db.php";
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
                <div class="titre" id="titre">STREAM</div>
                <form action="" method="get"></form>
                    <input type="search" onkeydown="searchKeyWord()" name="keyword" id="search" placeholder="Rechercher un livre">
                </form>
                <div style="display: flex;width:fit-content;align-items:center;justify-content:right;padding: 0 10px 0 10px;font-weight: 700;">
                    <script>
                        async function searchKeyWord() {
                            let keyword = document.getElementById("search").value;
                            let div = document.getElementById("disponible")
                            const req = await fetch(`search.php?keyword=${keyword}`);
                            const response = await req.json();

                            div.innerText(response)

                            //Afficher la reponse au format 

                        }
                    </script>
                    <ul>
                        <li><a href="../addBook/adbook.php"><button id="add">Ajouter un Livre</button></a></li>
                        <li><a href="informations.php">À Propos</a></li>
                        <li><a href="mailto:timotheeklaus@gmail.com">Contactez-nous</a></li>
                    </ul>
                </div>
            </nav>
            <div class="text">
                <h1>Bienvenue dans notre bibliothèque</h1>
                <div>
                    <img src="" alt="">
                    <p style="width: 50vw;margin: 0 auto;font-family: serif;font-size: .8em;">Plongez dans un océan de connaissance et d'histoires passionnantes<br>Découvrez notre collection de livres soigneusement selectionnés et enrichissez votre esprits<br>
                        Rejoignez-nous dans cette aventure littéraire et laissez chaque page tournée vous emmener vers de nouveaux horizons</p>
                </div>

            </div>
        </div>
        <?php
        if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
            $keyword = $_GET['keyword'];
            $req = $database->prepare('SELECT * FROM livre WHERE LOWER(titre_livre) LIKE LOWER(:keyword)');
            $req->execute(array(":keyword" => '%' . $keyword . '%'));
            while ($livre = $req->fetch()) {
                echo $livre['titre_livre'] . '<br>';
            }
        }
        ?>
        <h1>Disponibles</h1>
        <div class="disponible">

            <div style="display: flex;justify-content:center;align-items: center; gap : 25px;">
                <!-- Afficher les livres -->


                <?php
                // Récupérer tous les livres de la bibliothèque

                $reqLivre = $database->query('SELECT * FROM livre');
                $livres = $reqLivre->fetchAll(PDO::FETCH_ASSOC);
                $reqAuteur = $database->query('SELECT * FROM auteur');
                foreach ($livres as $livre) {
                    echo '<div class="card">
                        <div class="img-livre"><img src="' . $livre['image_url'] . '" alt=""></div>
                        <div class="content">
                
                        <h2>' . $livre['titre_livre'] . '</h2>';
                    $idAuteur = $livre['id_auteur'];
                    $reqAuteur = $database->prepare('SELECT nom_auteur,prenom_auteur FROM Auteur WHERE id_auteur = ?');
                    $reqAuteur->execute(array($idAuteur));
                    $idAuteur = $reqAuteur->fetch(PDO::FETCH_ASSOC);
                    while ($idAuteur) {
                        $nomAuteur = $idAuteur['nom_auteur'] . ' ' . $idAuteur['prenom_auteur'];
                        $idAuteur = $reqAuteur->fetch(PDO::FETCH_ASSOC);
                    }
                    $idAuteur = $livre['id_auteur'];
                    $idCategorie = $livre['id_categorie'];

                    $reqAuteur = $database->prepare('SELECT nom_auteur, prenom_auteur FROM Auteur WHERE id_auteur = ?');
                    $reqAuteur->execute(array($idAuteur));
                    $auteur = $reqAuteur->fetch(PDO::FETCH_ASSOC);

                    $reqCategorie = $database->prepare('SELECT libelle_categorie FROM categorie WHERE id_categorie = ?');
                    $reqCategorie->execute(array($idCategorie));
                    $categorie = $reqCategorie->fetch(PDO::FETCH_ASSOC);

                    if ($auteur) {
                        $nomAuteur = $auteur['nom_auteur'] . ' ' . $auteur['prenom_auteur'];
                    }

                    if ($categorie) {
                        $nomCategorie = $categorie['libelle_categorie'];
                    }

                    echo '<p><u>Auteur :</u> ' . $nomAuteur . '<br><u>Année :</u> ' . $livre['annee'] . '<br><u>Catégorie :</u> ' . $nomCategorie . '</p>
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

                $reqLivre = $database->query('SELECT * FROM livre WHERE annee >= 2024');
                $livres = $reqLivre->fetchAll(PDO::FETCH_ASSOC);

                $reqAuteur = $database->query('SELECT * FROM auteur');
                foreach ($livres as $livre) {
                    echo '<div class="card">
                        <div class="img-livre"><img src="' . $livre['image_url'] . '" alt=""></div>
                        <div class="content">
                
                        <h2>' . $livre['titre_livre'] . '</h2>';
                    $idAuteur = $livre['id_auteur'];
                    $idCategorie = $livre['id_categorie'];

                    $reqAuteur = $database->prepare('SELECT nom_auteur, prenom_auteur FROM Auteur WHERE id_auteur = ?');
                    $reqAuteur->execute(array($idAuteur));
                    $auteur = $reqAuteur->fetch(PDO::FETCH_ASSOC);

                    $reqCategorie = $database->prepare('SELECT libelle_categorie FROM categorie WHERE id_categorie = ?');
                    $reqCategorie->execute(array($idCategorie));
                    $categorie = $reqCategorie->fetch(PDO::FETCH_ASSOC);

                    if ($auteur) {
                        $nomAuteur = $auteur['nom_auteur'] . ' ' . $auteur['prenom_auteur'];
                    }

                    if ($categorie) {
                        $nomCategorie = $categorie['libelle_categorie'];
                    }

                    echo '<p><u>Auteur :</u> ' . $nomAuteur . '<br><u>Année :</u> ' . $livre['annee'] . '<br><u>Catégorie :</u> ' . $nomCategorie . '</p>
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


        <!-- il faut que je rajoute d'autres catégorie plus tard -->



</body>

</html>