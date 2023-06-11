<?php
session_start();

// Obtenir l'identifiant unique à partir de la session
if(isset($_SESSION["unique_id"])) {
    $searchId = $_SESSION["unique_id"];
} else {
    echo "L'identifiant unique n'est pas défini dans la session.";
    exit();
}

// Ouvrir le fichier CSV
$file = fopen('tmp.csv', 'r');

// Initialiser un compteur de lignes
$lineNumber = 0;
$data = [];

while (($line = fgetcsv($file)) !== FALSE) {
    $lineNumber++;
    // Ajout de la ligne au tableau de données
    $data[] = $line;
    // Vérifier si l'identifiant unique est dans la dernière colonne de cette ligne
    $lastData = end($line);
    if ($lastData == $searchId) {
        echo "L'identifiant unique se trouve à la ligne " . $lineNumber;
        break;
    }
}

fclose($file);

// Extraction des données de la ligne spécifiée
$userData = $data[$lineNumber - 1];
$email = $userData[0];
$nom = $userData[1];
$prenom = $userData[2];
$date = $userData[3];
$reseau = $userData[4];
$engagement = $userData[5];
$milieu = $userData[6];
$emailReferent = $userData[7];
$duree = $userData[8];
$car0 = isset($userData[9]) ? $userData[9] : '';
$car1 = isset($userData[10]) ? $userData[10] : '';
$car2 = isset($userData[11]) ? $userData[11] : '';
$car3 = isset($userData[12]) ? $userData[12] : '';
$uniqueId = end($userData);
?>


<script>
      document.addEventListener('DOMContentLoaded', function() {
        var referentLink = document.querySelector('.referent');
        var consultantLink = document.querySelector('.consultant');
        var administrateurLink = document.querySelector('.administrateur');

        // Fonction qui remplace le curseur par le symbole d'interdiction pour le lien référent
        function setForbiddenCursorReferent() {
          referentLink.classList.add('forbidden-cursor');
        }

        // Fonction qui restaure le curseur par défaut pour le lien référent
        function restoreDefaultCursorReferent() {
          referentLink.classList.remove('forbidden-cursor');
        }

        // Événement lorsque la souris entre dans la zone du lien référent
        referentLink.addEventListener('mouseenter', setForbiddenCursorReferent);

        // Événement lorsque la souris quitte la zone du lien référent
        referentLink.addEventListener('mouseleave', restoreDefaultCursorReferent);

        // Désactive le clic sur le lien référent
        referentLink.addEventListener('click', function(event) {
          event.preventDefault();
        });

        // Fonction qui remplace le curseur par le symbole d'interdiction pour le lien consultant
        function setForbiddenCursorConsultant() {
          consultantLink.classList.add('forbidden-cursor');
        }

        // Fonction qui restaure le curseur par défaut pour le lien consultant
        function restoreDefaultCursorConsultant() {
          consultantLink.classList.remove('forbidden-cursor');
        }

        // Événement lorsque la souris entre dans la zone du lien consultant
        consultantLink.addEventListener('mouseenter', setForbiddenCursorConsultant);

        // Événement lorsque la souris quitte la zone du lien consultant
        consultantLink.addEventListener('mouseleave', restoreDefaultCursorConsultant);

        // Désactive le clic sur le lien consultant
        consultantLink.addEventListener('click', function(event) {
          event.preventDefault();
        });
        // Fonction qui remplace le curseur par le symbole d'interdiction pour le lien "administrateur"
  function setForbiddenCursorAdministrateur() {
    administrateurLink.classList.add('forbidden-cursor');
  }

  // Fonction qui restaure le curseur par défaut pour le lien "administrateur"
  function restoreDefaultCursorAdministrateur() {
    administrateurLink.classList.remove('forbidden-cursor');
  }

  // Événement lorsque la souris entre dans la zone du lien "administrateur"
  administrateurLink.addEventListener('mouseenter', setForbiddenCursorAdministrateur);

  // Événement lorsque la souris quitte la zone du lien "administrateur"
  administrateurLink.addEventListener('mouseleave', restoreDefaultCursorAdministrateur);

  // Désactive le clic sur le lien "administrateur"
  administrateurLink.addEventListener('click', function(event) {
    event.preventDefault();
  });
      });
    </script>


<!DOCTYPE html>
<html>
  <head>
    <title>Mon Site</title>
    <meta charset="UTF-8">
    <meta name="description" content="Description de mon site.">
    <meta name="keywords" content="Mots-clés, pour, mon, site.">
    <link rel="stylesheet" href="jeunes.css">
    <link rel="stylesheet" href="uploads.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

  </head>
  <p class="footer-text"><span style="font-size: 80px; color: rgb(229, 0, 126)"; > JEUNE</p></span>
  <body>
    
      
      <header class="top-bar">
        <div class="element">

          <img src="logoJeunes.png" alt="Image">
        </div>
        <footer>
          <p class="footer-text">Je donne de la valeur à mon engagement</p>
        </footer>
      </header>
       

        <ul class="menu">
          <li class="menuj">
            <a href="jeunes.php" class="jeunes"><span style="background-color:rgb(229, 0, 126); color: white";>JEUNES</a>
            <ul class="submenu">
      <li><a href="jeunes.php">Modification de profil</a></li>
      <li><a href="jeunescv.php">Téléchargement de CV</a></li>
      <li><a href="accueilJeunes.php">Demandes de référents</a></li>
      <li><a href="accueilJeunes.php">Déconnexion</a></li>
    </ul>
          </li>
          <li class="menur">
            <a href="référent.php" class="referent">REFERENT</a>
          </li>
          <li class="menuc">
            <a href="consultant.php" class="consultant">CONSULTANT</a>
          </li>
          <li class="menup">
            <a href="partenaires.html" class="partenaires">PARTENAIRES</a>
          </li>
          <li class="menua">
            <a href="administrateur.html" class="administrateur">ADMINISTRATEUR</a>
          </li>
        </ul>
        
       

        <h2> Récapitulatif </h2>
        <div class="centered-form">
  <div class="btn">
    <form action="submit.php" method="post">
      Email: <input type="text" name="email" value="<?php echo $email; ?>" readonly><br>
      Nom: <input type="text" name="nom" value="<?php echo $nom; ?>" readonly><br>
      Prénom: <input type="text" name="prenom" value="<?php echo $prenom; ?>" readonly><br>
      Date de naissance: <input type="text" name="date" value="<?php echo $date; ?>" readonly><br>
      Réseau: <input type="text" name="reseau" value="<?php echo $reseau; ?>" readonly><br>
      Engagement: <input type="text" name="engagement" value="<?php echo $engagement; ?>" readonly><br>
      Milieu: <input type="text" name="milieu" value="<?php echo $milieu; ?>" readonly><br>
      Email Référent: <input type="text" name="emailReferent" value="<?php echo $emailReferent; ?>" readonly><br>
      Durée: <input type="text" name="duree" value="<?php echo $duree; ?>" readonly><br>
      Qualité: <input type="text" name="qualité" value="<?php echo $car0 ." ". $car1 ." ". $car2 ." ". $car3; ?>" readonly><br>
    </form>
  </div>
</div>




<?php
$target_dir = "uploads/";

// Obtenez l'e-mail de l'utilisateur à partir de la session
if(isset($_SESSION["user_email"])) {
    $user_email = $_SESSION["user_email"];
} else {
    echo "Veuillez vous connecter pour télécharger un fichier.";
    exit();
}

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Remplacer le nom du fichier par l'email de l'utilisateur
$target_file = $target_dir . $user_email . ".pdf";

$uploadOk = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["submit"])) {
        $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
        if($fileType != "pdf") {
            echo "Seuls les fichiers PDF sont autorisés.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Le fichier a été téléchargé avec succès.";
        } else {
            echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
        }
    }
}
$message = "Votre dossier a bien été pris en compte avec votre CV";
?>

<p class="message"><?php echo $message; ?></p>
