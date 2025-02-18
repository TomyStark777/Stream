<?php

include "../config/db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require '../vendor/autoload.php';

$title = $_POST['title'];
$year = $_POST['year'];
$isbn = $_POST['isbn'];
$author = $_POST['author'];
$langue = $_POST['langue'];
$genre = $_POST['genre'];
$resume = $_POST['resume'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK && isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
    $pdfTmpPath = $_FILES['pdf']['tmp_name'];
    $pdfName = $_FILES['pdf']['name'];

    $imageTmpPath = $_FILES['cover']['tmp_name'];
    $imageName = $_FILES['cover']['name'];

    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'koumondjitimotheeklaus@gmail.com'; // Remplace par ton adresse email Gmail
        $mail->Password = 'biri ovyy cjcz ddwc'; // Remplace par ton mot de passe Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // Destinataires
        $mail->setFrom('koumondjitimotheeklaus@gmail.com', 'STREAM');
        $mail->addAddress('richardtchassema1@gmail.com', 'Richard TCHASSEMA');

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = 'Ajout d\'un Livre sur Stream';
        $mail->Body    = "<!DOCTYPE html>
    <html>

    <head>
        <meta charset=\"UTF-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
        <title>Document</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 800px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: left;
            }

            th {
                background-color: #f4f4f4;
            }
        </style>
    </head>

    <body>
        <div class=\"container\">
            <h1>Demande d'ajout sur STREAM</h1>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Paramètre</th>
                            <th>Valeur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Titre</td>
                            <td>
                                ".$title."
                            </td>
                        </tr>
                        <tr>
                            <td>Année</td>
                            <td>
                                ".$year."
                            </td>
                        </tr>
                        <tr>
                            <td>ISBN</td>
                            <td>
                                ".$isbn."
                            </td>
                        </tr>
                        <tr>
                            <td>Auteur</td>
                            <td>
                                ".$author."
                            </td>
                        </tr>
                        <tr>
                            <td>Langue</td>
                            <td>
                                ".$langue."
                            </td>
                        </tr>
                        <tr>
                            <td>Genre</td>
                            <td>
                                ".$genre."
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> <br><br><br>
            <p><b>Description :</b> ".$resume."<p/>
        </div>
    </body>

    </html>";

    // Pièce jointe (PDF)
    $mail->addAttachment($pdfTmpPath, $pdfName);
    // Pièce jointe (image)
    $mail->addAttachment($imageTmpPath, $imageName);

    // Envoi du mail
    $mail->send();
    header('Location: ./message.html');

    } catch (Exception $e) {
        echo 'L\'envoi de l\'email a échoué. Erreur: ', $mail->ErrorInfo;
    }
} else{
    die("<br/><font color='red'>Veuillez sélectionner un fichier pour l'ajout sur Stream.</font>");
}

?>