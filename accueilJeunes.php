<!DOCTYPE html>
<html>
<head>
    <title>Mon Site</title>
    <meta charset="UTF-8">
    <meta name="description" content="Description de mon site.">
    <meta name="keywords" content="Mots-clés, pour, mon, site.">
    <link rel="stylesheet" href="jeunes.css">
    <link rel="stylesheet" href="accueilJeunes.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
</head>
<body>
    <!-- En-tête avec le texte "JEUNE" -->
    <p class="footer-text"><span style="font-size: 80px; color: rgb(229, 0, 126)"; > JEUNE</p></span>

    <header class="top-bar">
        <div class="element">
            <!-- Logo -->
            <img src="logoJeunes.png" alt="Image">
        </div>
        <footer>
            <!-- Texte de pied de page -->
            <p class="footer-text">Je donne de la valeur à mon engagement</p>
        </footer>
    </header>

    <ul class="menu">
        <!-- Liens du menu -->
        <li class="menuj">
            <a href="jeunes.php" class="jeunes"><span style="background-color:rgb(229, 0, 126); color: white";>JEUNES</a>
        </li>
        <li class="menur">
            <a href="référent.php" class="referent">REFERENT</a>
        </li>
        <li class="menuc">
            <a href="consultant.php" class="consultant">CONSULTANT</a>
        </li>
        <li class="menup">
            <a href="partenaires.php" class="partenaires">PARTENAIRES</a>
        </li>
        <li class="menua">
            <a href="administrateur.php" class="administrateur">ADMINISTRATEUR</a>
        </li>
    </ul>

    <h2>Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</h2>

    <div class="consultationtitle"><b>Demande de consultation</b></div>

    <img src="logorose1.png" class="background-logo">

    <div class="button-container">
        <a href="jeunes.php" class="btn">Demande de Référent</a>
        <form method="POST" action="connex.php">
            <button type="submit" name="deco">Déconnexion</button>
        </form>
    </div>

    <div class="body-container">
        <form class="email-form" action="" method="post">
            <input type="text" name="consultant_email" placeholder="Email du consultant"><br>
            <input type="text" name="referent_email" placeholder=" Email du référent"><br>
            <input class="submit-button" type="submit">
        </form>

        <h3>Vos demandes de références</h3>
    </div>

</body>
</html>

<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (isset($_SESSION["user_email"])) {
  
} else {
  
}

$user_mail = $_SESSION["user_email"];

// Gestion de la déconnexion
if (isset($_POST['deco'])) {
    session_destroy();
    header('Location: connex.php');
    exit();
}
?>

<?php
// Inclusion des fichiers PHPMailer nécessaires
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$referentEmail = "";
if (isset($_POST['consultant_email']) && isset($_POST['referent_email'])) {
    $consultantEmail = $_POST['consultant_email'];
    $referentEmail = $_POST['referent_email'];   
    // Les adresses e-mail du consultant et du référent sont maintenant stockées dans $consultantEmail et $referentEmail
    // Vous pouvez les utiliser comme bon vous semble
}

$file1 = fopen('tmp.csv', 'r');
$lineNumbertmp = 0;
$foundLinetmp = -1;

while (($line = fgetcsv($file1)) !== FALSE) {
    $lineNumbertmp++;

    // Vérifie si la première colonne (index 0) correspond à $user_mail
    // et si la huitième colonne (index 7) correspond à $referentEmail
    if ($line[0] == $user_mail && $line[7] == $referentEmail) {
        $foundLinetmp = $lineNumbertmp;
        break;
    }
}

fclose($file1);

$file2 = fopen('refCombined.csv', 'r');
$lineNumberref = 0;
$foundLineref = -1;

while (($line = fgetcsv($file2)) !== FALSE) {
    $lineNumberref++;

    // Vérifie si la première colonne (index 0) correspond à $user_mail
    // et si la deuxième colonne (index 1) correspond à $referentEmail
    if ($line[0] == $user_mail && $line[1] == $referentEmail) {
        $foundLineref = $lineNumberref;
        break;
    }
}

fclose($file2);

// Si $foundLinetmp est différent de -1, cela signifie que la demande est en attente
if ($foundLinetmp != -1 && $foundLineref == -1) {
    echo "<p style='color: rgb(229, 0, 126); margin-top:-15%; margin-left:0%;'>Votre demande est en attente, veuillez réessayer ultérieurement</p>";
}

// Si $foundLinetmp et $foundLineref sont tous deux égaux à -1, cela signifie que l'utilisateur n'a pas de référent avec cette adresse e-mail
if ($foundLinetmp == -1 && $foundLineref == -1) {
    echo "<p style='color: rgb(229, 0, 126); margin-top:-15%; margin-left:0%;'>Vous n'avez pas de référent possédant cette adresse e-mail</p>";
}

// Si $foundLinetmp est différent de -1 et $foundLineref est différent de -1, cela signifie que la demande et la référence sont trouvées
if ($foundLinetmp != -1 && $foundLineref != -1) {
    echo "Ligne ref trouvée à la position : " . $foundLineref;

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->Port       = 587;
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mailjeunes6.4@gmail.com';
        $mail->Password   = 'hlddoflplovfftkd';
        $mail->SMTPSecure = 'tls';
        
        $mail->setFrom('mailjeunes6.4@gmail.com');
        $mail->addAddress($consultantEmail, '');
        $mail->addAttachment('uploads/' . $_SESSION['user_email'] . '.pdf');
        $mail->Subject = 'Demande de consultation';
        $url = "http://localhost/ProjetJeune/consultant.php?lignejeune=".$foundLinetmp."&ligneref=".$foundLineref;
        $mail->Body = 'Cliquez sur ce lien pour accéder à la page : '.$url;

        $mail->SMTPOptions = array(
            'ssl' => array (
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->send();
        
        echo 'Email envoyé';
    } catch(Exception $e) {
        echo 'Erreur envoi ' . $mail->ErrorInfo;
    }
}
?>

<?php
$user_email = $_SESSION["user_email"];
$file = fopen('tmp.csv', 'r');
$matches = [];

while (($line = fgetcsv($file)) !== FALSE) {
    if ($line[0] == $user_email) {
        if (isset($line[7])) {
            $matches[] = $line[7];
        }
    }
}

fclose($file);

$fileCombined = fopen('refCombined.csv', 'r');
$combined_lines = [];

while (($lineCombined = fgetcsv($fileCombined)) !== FALSE) {
    $combined_lines[] = $lineCombined;
}

fclose($fileCombined);

$matches_updated = [];

foreach ($matches as $match) {
    $found = false;

    foreach($combined_lines as $lineCombined){
        if ($lineCombined[0] == $user_email && $lineCombined[1] == $match) {
            $matches_updated[] = ['match' => $match, 'response' => 'Répondu'];
            $found = true;
        }
    }

    if(!$found) {
        $matches_updated[] = ['match' => $match, 'response' => 'En attente'];
    }
}

echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
echo '<table style="border:1px solid black; background-color: pink; text-align: center; margin-top:-80%; margin-left:70%">';
foreach ($matches_updated as $match_updated) {
    echo '<tr><td style="border:1px solid black;">' . $match_updated['match'] . '</td><td style="border:1px solid black;">' . $match_updated['response'] . '</td></tr>';
}
echo '</table>';
echo '</div>';
?>
