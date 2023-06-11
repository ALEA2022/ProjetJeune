
<?php
$lignejeune = isset($_GET['lignejeune']) ? intval($_GET['lignejeune'])  : 0;

// Lire le fichier CSV
$data = array();
if (($handle = fopen("tmp.csv", "r")) !== FALSE) {
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $data[] = $row;
    }
    fclose($handle);
}

// Vérifiez si la ligne demandée existe dans le fichier CSV
if (isset($data[$lignejeune - 1])) {
    $userData = $data[$lignejeune - 1];
    $email = $userData[0];
    $nom = $userData[1];
    // etc...
} else {
}






$userData = $data[$lignejeune - 1];
$nom = $userData[1];
$prenom = $userData[2];
$date = $userData[3];
$reseau = $userData[4];
$engagement = $userData[5];
$email = $userData[7];
$duree = $userData[8];
$car0 = isset($userData[9]) ? $userData[9] : '';
$car1 = isset($userData[10]) ? $userData[10] : '';
$car2 = isset($userData[11]) ? $userData[11] : '';
$car3 = isset($userData[12]) ? $userData[12] : '';


?>
<?php

$ligneref = isset($_GET['ligneref']) ? intval($_GET['ligneref'])  : 0;
// Lire le fichier CSV
$data = array();
if (($handle = fopen("refCombined.csv", "r")) !== FALSE) {
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $data[] = $row;
    }
    fclose($handle);
}

// Vérifiez si la ligne demandée existe dans le fichier CSV
if (isset($data[$ligneref - 1])) {
    $userData = $data[$ligneref - 1];
    $email = $userData[0];
    $nom = $userData[1];
    // etc...
} else {
}



$userData = $data[$ligneref - 1];
$nomref = $userData[3];
$prenomref = $userData[2];
$dateref = $userData[4];
$reseauref = $userData[5];
$presentation = $userData[6];
$emailref = $userData[1];
$dureeref = $userData[7];
$ref0 = isset($userData[8]) ? $userData[8] : '';
$ref1 = isset($userData[9]) ? $userData[9] : '';
$ref2 = isset($userData[10]) ? $userData[10] : '';
$ref3 = isset($userData[11]) ? $userData[11] : '';

?>




  
        <!DOCTYPE html>
<html>
  <head>
    <title>Mon Site</title>
    <meta charset="UTF-8">
    <meta name="description" content="Description de mon site.">
    <meta name="keywords" content="Mots-clés, pour, mon, site.">
    <link rel="stylesheet" href="jeunesconsult.css">
    <link rel="stylesheet" href="referentconsult.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

  </head>
  <p class="footer-text"><span style="font-size: 80px; color: rgb(0, 159,227)"; >CONSULTANT</p></span>
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
        <li class="menus">
            <a href="projetsite.php" class="presentationS">PRESENTATION</a>
          </li>
          <li class="menuj">
            <a href="jeunes.php" class="jeunes">JEUNES</a>
          </li>
          <li class="menur">
            <a href="référent.php" class="referent">REFERENT</a>
          </li>
          <li class="menuc">
            <a href="consultant.php" class="consultant"><span style="background-color: rgb(0, 159,227); color: white";>CONSULTANT</a>
          </li>
          <li class="menup">
            <a href="partenaires.html" class="partenaires">PARTENAIRES</a>
          </li>
          <li class="menua">
            <a href="administrateur.html" class="administrateur">ADMINISTRATEUR</a>
          </li>
        </ul>
        
        <h2> <span style="color: rgb(0, 159,227);";>Décrivez votre experience et mettez en avant ce que vous en avez retiré.</h2>

 <div id="container" >      


<div id="main">      
<form action="submit.php" method="post">
      <div class="fieldset">
      <div class=h2bis> <span style="color: rgb(230, 0, 126)";>JEUNE </div>
      <br>
      <div id="text_field">
   
      Nom: <input type="text" name="nom" value="<?php echo $nom; ?>" readonly><br>
      Prénom: <input type="text" name="prenom" value="<?php echo $prenom; ?>" readonly><br>
      Date de naissance: <input type="text" name="date" value="<?php echo $date; ?>" readonly><br>
      Email: <input type="text" name="emailReferent" value="<?php echo $email; ?>" readonly><br>
      Réseau social: <input type="text" name="reseau" value="<?php echo $reseau; ?>" readonly><br><br>
      Engagement: <input type="text" name="engagement" value="<?php echo $engagement; ?>" readonly><br>
      Durée: <input type="text" name="duree" value="<?php echo $duree; ?>" readonly><br>
      
      <div id="qualitej-container">
      <div class="titlecheckj">
                  <div class="jesuis">Je suis*</div>
                  </div>
     <input type="text" name="qualité" value="<?php echo $car0 ." ". $car1 ." ". $car2 ." ". $car3; ?>" readonly><br>
      </div>
      </div>
      
      </div>
    </form>
  
</div>


<div id="main1">  
      <form action="submit.php" method="post">
      <div class="fieldset1">
     
      <div class=h2bis> <span style="color: rgb(195,211,13)";>REFERENT </div>
      <br>
      <div id="text_field1">
      Nom: <input type="text" name="nom" value="<?php echo $nomref; ?>" readonly><br>
      Prénom: <input type="text" name="prenom" value="<?php echo $prenomref; ?>" readonly><br>
      Date de naissance: <input type="text" name="date" value="<?php echo $dateref; ?>" readonly><br>
      Email Référent: <input type="text" name="emailReferent" value="<?php echo $emailref; ?>" readonly><br>
      Réseau social: <input type="text" name="reseau" value="<?php echo $reseauref; ?>" readonly><br><br>
      Présentation: <input type="text" name="engagement" value="<?php echo $presentation; ?>" readonly><br>
      Durée: <input type="text" name="duree" value="<?php echo $dureeref; ?>" readonly><br>
      <div id="qualite-container">
      <div class="titlecheck">
                  <div class="jesuis">Je confirme sa (son)*</div>
                  </div>
      
      <input type="text" name="qualité" value="<?php echo $ref0 ." ". $ref1 ." ". $ref2 ." ". $ref3; ?>" readonly><br>
      </div>
      </div>
      </div>
    </form>
  
</div>


</div>
<img src="logobleu2.png" class="background-logo" >


<?php
$target_dir = "uploads/";

// Obtenez l'e-mail de l'utilisateur à partir de la session
if(isset($_SESSION["user_email"])) {
    $user_email = $_SESSION["user_email"];
} else {
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


