<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="titre">STREAM</div>
        <div style="display: flex;width:fit-content;;align-items:center;justify-content:right;padding: 0 10px 0 10px;font-weight: 700;">
            <ul>
                <li>Déjà inscrit ?&nbsp;<a href="../connexion/connexion.php">Connectez-vous</a></li>
                <li><a href="informations.php">À Propos</a></li>
                <li><a href="tel:+22891918687">Contactez-nous</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">

        <div class="formulaire">
            <h2>Inscrivez-vous</h2>
            <?php
            if (isset($_GET['user']) && $_GET['user'] == 'true') {
                echo '<p style="color:red;">Compte déjà existant pour cet E-mail</p>';
            }
            ?>
            <form action="inscription.php" method="post" id="form">
                <div class="formDiv"></div>
                <div class="formDiv"></div>
                <div class="formDiv"></div>
            </form>
        </div>
            <select name="pays" id="pays">
                <option disabled selected>Pays</option>
                <option value="Togo">Togo</option>
                <option value="Bénin">Bénin</option>
            </select>
    </div>
</body>

</html>