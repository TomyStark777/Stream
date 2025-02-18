<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre !</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <div class="titre">STREAM</div>
        <div style="display: flex;width:fit-content;;align-items:center;justify-content:right;padding: 0 10px 0 10px;font-weight: 700;">
            <ul>
                <li>Pas de compte ?&nbsp;<a href="../newAccount/newAccount.php">Créez un compte</a></li>
                <li><a href="informations.php">À Propos</a></li>
                <li><a href="mailto:timotheeklaus@gmail.com">Contactez-nous</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">

        <form action="traitement.php" method="post" enctype="multipart/form-data">
            <h1>Informations sur l'Ouvrage </h1>
            <div class="top">
                <div class="left">
                    <input type="text" name="title" id="title" placeholder="Titre" required>
                    <input type="number" name="year" id="year" placeholder="Année" required>
                    <input type="number" name="isbn" id="isbn" placeholder="ISBN" required>
                    <input type="text" name="author" id="author" placeholder="Auteur" required>
                    <select name="langue" id="langue" required>
                        <option value="" disabled selected>Langue du Livre</option>
                        <option value="Français">Français</option>
                        <option value="Anglais">Anglais</option>
                        <option value="Allemand">Allemand</option>
                        <option value="Italien">Italien</option>
                        <option value="Russe">Russe</option>
                        <option value="Portugais">Portugais</option>
                        <option value="Espagnol">Espagnol</option>
                        <option value="Chinois">Chinois</option>
                        <option value="Japonais">Japonais</option>
                    </select>
                    <select name="genre" id="genre" required>
                        <option value="" disabled selected>Genre</option>
                        <option value="1">Drame</option>
                        <option value="2">Action</option>
                        <option value="3">Thriller</option>
                        <option value="4">Horreur</option>
                        <option value="5">Fantastique</option>
                        <option value="6">Fantaisie</option>
                        <option value="7">Comédie</option>
                        <option value="8">Tranche de Vie</option>
                        <option value="9">Historique</option>
                    </select>

                </div>
                <div class="right">
                    <label for="cover">Image de la Couverture : </label>
                    <input type="file" accept=".jpg, .png, .jpeg" name="cover" id="cover" placeholder="Couverture" required>
                    <label for="pdf">Fichier PDF : </label>
                    <input type="file" accept=".pdf" name="pdf" id="pdf" placeholder="Chargez le fichier PDF" required>
                </div>
            </div>
            <textarea name="resume" id="" placeholder="Saisissez un résumé du Livre (400 caractères max)" rows="4" cols="50" maxlength="400" required></textarea>
            <button type="submit">Ajouter à la Collection</button>
        </form>
    </div>
</body>

</html>