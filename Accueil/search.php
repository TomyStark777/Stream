<?php
include "../config/db.php";

if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
    $keyword = $_GET['keyword'];
    $req = $database->prepare('SELECT * FROM livre WHERE LOWER(titre_livre) LIKE LOWER(:keyword)');
    $req->execute(array(":keyword" => '%' . $keyword . '%'));
}
?>
<!-- <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Recherche</title>
</head>

<body>
    <form action="search.php" method="get">
        <input type="text" name="keyword" placeholder="Rechercher un livre">
        <button type="submit">Rechercher</button>
    </form>

    <?php
    // if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
    //     $keyword = $_GET['keyword'];
    //     $req = $database->prepare('SELECT * FROM livre WHERE LOWER(titre_livre) LIKE LOWER(:keyword)');
    //     $req->execute(array(":keyword" => '%' . $keyword . '%'));
    //     while ($livre = $req->fetch()) {
    //         echo $livre['titre_livre'] . '<br>';
    //     }
    // }
    ?>
</body>

</html> -->