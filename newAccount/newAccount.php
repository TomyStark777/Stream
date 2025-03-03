<!DOCTYPE html>
<html lang="fr">

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
            <p id="champVide">Veuillez remplir tous les champs</p>
            <?php
            if (isset($_GET['user']) && $_GET['user'] == 'true') {
                echo '<p style="color:red;">Compte déjà existant pour cet E-mail</p>';
            }
            ?>
            <form action="inscription.php" method="post" id="form">
                <div class="formDiv">
                    <input type="text" name="nom" id="nom" placeholder="Nom" required>
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
                    <input type="email" name="email" id="email" placeholder="E-mail" required>
                </div>
                <div class="formDiv" style="display:none;">
                    <input type="password" name="password" id="password" placeholder="Mot de Passe" required>
                    <div style="width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmez votre mot de Passe" required>
                        <span id="erreurCode" style="color: red; display: none; font-size: 10px; text-align: left;margin: 0; width: 90%;">Les mots de passe ne correspondent pas</span>
                    </div>
                    <input type="number" name="tel" id="tel" placeholder="Numéro de Téléphone" required>
                    <select name="pays" id="liste-pays" required>
                        <option disabled selected>Pays de Résidence</option>
                        <!-- Options générées automatiquement -->
                    </select>

                    <script>
                        document.getElementById("confirmPassword").addEventListener("input", comparePassword);

                        function comparePassword() {
                            document.getElementById("confirmPassword").style.marginBottom = "0";
                            let submitButton = document.getElementById('create');
                            let password = document.getElementById("password").value;
                            let confirmPassword = document.getElementById("confirmPassword").value;
                            let erreurCode = document.getElementById("erreurCode");

                            if (password !== confirmPassword) {
                                submitButton.style.backgroundColor = "gray";
                                submitButton.disabled = true;
                                erreurCode.style.display = "flex";
                            } else {
                                submitButton.style.background = "linear-gradient(to right bottom,rgb(29, 29, 254),rgb(115, 26, 239))";
                                submitButton.disabled = false;
                                erreurCode.style.color = "green";
                                erreurCode.innerText = "Les mots de passes correspondent";
                            }
                        }


                        // URL de l'API REST Countries
                        const apiURL = 'https://restcountries.com/v3.1/all';

                        // Récupérer les données de l'API et générer les options
                        fetch(apiURL)
                            .then(response => response.json())
                            .then(data => {
                                // Trier les pays par nom
                                data.sort((a, b) => a.name.common.localeCompare(b.name.common));

                                const select = document.getElementById('liste-pays');

                                // Générer les options de la liste déroulante
                                data.forEach(country => {
                                    const option = document.createElement('option');
                                    option.value = country.name.common;
                                    option.text = country.name.common;
                                    select.add(option);
                                });
                            })
                            .catch(error => console.error('Erreur:', error));
                    </script>

                </div>
                <button id="continuer">Continuer</button>
                <button type="submit" id="create">Terminer</button>
            </form>
        </div>
    </div>
</body>

</html>