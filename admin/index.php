<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

// Génère un ID aléatoire
function generateRandomID($length = 6)
{
    return strtoupper(substr(bin2hex(random_bytes($length)), 0, $length));
}

// Envoi d'e-mail
function sendEmail($toEmail, $code)
{
    $mail = new PHPMailer(true);

    try {
        // Configurer le serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Hôte SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'koumondjitimotheeklaus@gmail.com'; // Remplacer par votre e-mail
        $mail->Password = 'biri ovyy cjcz ddwc'; // Remplacer par votre mot de passe
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Paramètres de l'e-mail
        $mail->setFrom('koumondjitimotheeklaus@gmail.com', 'STREAM'); // Remplacer par votre e-mail
        $mail->addAddress($toEmail);
        $mail->isHTML(true);
        $mail->Subject = 'Code de Validation';
        $mail->Body = "<p>Voici votre code : <strong>$code</strong></p>";

        $mail->send();
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
    }
}

// Traitement de la requête
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    $code = generateRandomID();
    $_SESSION['generated_code'] = $code; // Stocke le code dans la session
    sendEmail($email, $code);
    header('Location: verify.php');
    exit();
}
?>

<!-- Page HTML pour entrer l'e-mail -->
<!DOCTYPE html>
<html>

<head>
    <title>Envoyer le Code</title>
</head>

<body>
    <form method="post" action="">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Envoyer le Code</button>
    </form>
</body>

</html>