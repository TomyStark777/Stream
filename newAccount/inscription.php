<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @font-face {
            font-family: "LastChristmas";
            src: url(../Fonts/LastChristmas.otf);
        }

        body {
            background: linear-gradient(to left top, skyblue, aliceblue);
            background-repeat: no-repeat;
            background-size: contain;
            padding: 0;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .container {
            display: flex;
            background-color: #fff;
            height: 15vmax;
            width: 30vmax;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: "LastChristmas";
            font-size: 150%;
            font-weight: 800;
            border-radius: 15px;
        }

        .container img {
            width: 10%;
        }

        .container button {
            background: linear-gradient(to right bottom, rgb(29, 29, 254), rgb(115, 26, 239));
            color: #fff;
            font-weight: 700;
            height: 5vh;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            box-sizing: border-box;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    include "../config/db.php";
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pays = $_POST['pays'];
    $tel = $_POST['tel'];
    


    $req = $database->query('SELECT email FROM abonnee');
    while ($dbEmail = $req->fetch()) {
        if ($dbEmail['email'] === $email) {
            header('Location: newAccount.php?user=true');
            exit();
        }
    };

    $req = $database->prepare('INSERT INTO abonnee(nom,prenom,email,password,nom_pays,tel) VALUES (?,?,?,?,?,?)');
    $req->execute(array($nom, $prenom, $email, $password, $pays, $tel));
    ?>

    <div class="container">

        <img src="../image/mark.png" alt="">
        <p>Votre compte a été créé avec succès !</p>
        <a href="../connexion/connexion.php"><button>Connectez-vous</button></a>

    </div>

</body>

</html>
