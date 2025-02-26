<<<<<<< HEAD
=======
<?php
session_start()
?>
>>>>>>> b1d702b5e6e4b3e946c13cddbc15d6a5efdfe36d
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="titre">STREAM</div>
        <div style="display: flex;width:fit-content;;align-items:center;justify-content:right;padding: 0 10px 0 10px;font-weight: 700;">
            <ul>
<<<<<<< HEAD
                <li>Pas de compte ?&nbsp;<a href="../newAccount/newAccount.php?page=1">Créez un compte</a></li>
=======
                <li>Pas de compte ?&nbsp;<a href="../newAccount/newAccount.php">Créez un compte</a></li>
>>>>>>> b1d702b5e6e4b3e946c13cddbc15d6a5efdfe36d
                <li><a href="informations.php">À Propos</a></li>
                <li><a href="mailto:timotheeklaus@gmail.com">Contactez-nous</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">

        <div class="formulaire">
            <h2>Connectez-vous</h2>
            <?php // Affichage du message d'erreur si défini 
            if (isset($_GET['error']) && $_GET['error'] == 'incorrect') {
                echo '<p style="color: red;">Mot de passe incorrect, veuillez réessayer.</p>';
            } ?>
            <form action="traitement.php" method="post">
                <input type="email" name="email" id="email" placeholder="E-mail" required>
                <input type="password" name="keyword" id="keyword" placeholder="Mot de Passe" required>
                <p><a href="forgotPassword.php">Mot de Passe Oublié ?</a></p>
<<<<<<< HEAD

=======
                
>>>>>>> b1d702b5e6e4b3e946c13cddbc15d6a5efdfe36d
                <button type="submit">Connexion</button>
            </form>

        </div>

    </div>
</body>

</html>