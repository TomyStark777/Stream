<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['code'])) {
    $userCode = $_POST['code'];
    if ($userCode === $_SESSION['generated_code']) {
        header('Location: success.php');
        exit();
    } else {
        echo "Code incorrect. Veuillez réessayer.";
    }
}
?>

<!-- Page HTML pour entrer le code -->
<!DOCTYPE html>
<html>

<head>
    <title>Vérifier le Code</title>
</head>

<body>
    <form method="post" action="">
        <label for="code">Code :</label>
        <input type="text" id="code" name="code" required>
        <button type="submit">Vérifier</button>
    </form>
</body>

</html>