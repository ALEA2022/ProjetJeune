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
    echo "La ligne demandée n'existe pas dans le fichier CSV.";
}

// récupration des données du jeunes à partir du fichier tmp.csv
echo $lignejeune;


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
    echo "La ligne demandée n'existe pas dans le fichier CSV.";
}

// récupration des données du référent à partir du fichier refCombined.csv
echo $ligneref;

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
<title>Mon Site</title> <!-- Titre de la page -->
<meta charset="UTF-8">
<meta name="description" content="Description de mon site."> <!-- Balise méta pour la description du site -->
<meta name="keywords" content="Mots-clés, pour, mon, site."> <!-- Balise méta pour les mots-clés du site -->
<link rel="stylesheet" href="jeunesconsult.css"> <!-- Lien vers la feuille de style CSS jeunesconsult.css -->
<link rel="stylesheet" href="referentconsult.css"> <!-- Lien vers la feuille de style CSS referentconsult.css -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclusion de la bibliothèque jQuery -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css"> <!-- Lien vers le thème de jQuery UI -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script> <!-- Inclusion de jQuery UI -->
</head>
<p class="footer-text"><span style="font-size: 80px; color: rgb(0, 159,227)"; >CONSULTANT</p></span> <!-- Paragraphe avec classe footer-text et style pour la taille et la couleur du texte -->
<body>
<header class="top-bar"> <!-- Balise header avec classe top-bar -->
<div class="element">
<img src="logoJeunes.png" alt="Image"> <!-- Image avec l'attribut alt -->
</div>
<footer>
<p class="footer-text">Je donne de la valeur à mon engagement</p> <!-- Paragraphe avec classe footer-text -->
</footer>
</header>
<ul class="menu"> <!-- Liste non ordonnée avec classe menu -->
<li class="menus">
<a href="projetsite.php" class="presentationS">PRESENTATION</a> <!-- Lien vers projetsite.php avec classe presentationS -->
</li>
<li class="menuj">
<a href="jeunes.php" class="jeunes">JEUNES</a> <!-- Lien vers jeunes.php avec classe jeunes -->
</li>
<li class="menur">
<a href="référent.php" class="referent">REFERENT</a> <!-- Lien vers référent.php avec classe referent -->
</li>
<li class="menuc">
<a href="consultant.php" class="consultant"><span style="background-color: rgb(0, 159,227); color: white";>CONSULTANT</a> <!-- Lien vers consultant.php avec classe consultant et style pour la couleur de fond et la couleur du texte -->
</li>
<li class="menup">
<a href="partenaires.html" class="partenaires">PARTENAIRES</a> <!-- Lien vers partenaires.html avec classe partenaires -->
</li>
<li class="menua">
<a href="administrateur.html" class="administrateur">ADMINISTRATEUR</a> <!-- Lien vers administrateur.html avec classe administrateur -->
</li>
</ul>
<h2> <span style="color: rgb(0, 159,227);";>Décrivez votre experience et mettez en avant ce que vous en avez retiré.</h2> <!-- Titre de niveau 2 avec style pour la couleur du texte -->
<div id="container" > <!-- Div avec identifiant container -->
<div id="main"> <!-- Div avec identifiant main -->
<form action="submit.php" method="post"> <!-- Formulaire avec action vers submit.php et méthode post -->
<div class="fieldset"> <!-- Div avec classe fieldset -->
<div class=h2bis> <span style="color: rgb(230, 0, 126)";>JEUNE </div> <!-- Titre avec classe h2bis et style pour la couleur du texte -->
<br>
<div id="text_field"> <!-- Div avec identifiant text_field -->
Nom: <input type="text" name="nom" value="<?php echo $nom; ?>" readonly><br> <!-- Champ de saisie de texte avec nom, valeur dynamique et attribut readonly -->
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
<input type="text" name="qualité" value="<?php echo $car0 ." ". $car1 ." ". $car2 ." ". $car3; ?>" readonly><br> <!-- Champ de saisie de texte avec nom, valeur dynamique et attribut readonly -->
</div>
</div>
</div>
</form>
</div>
<div id="main1"> <!-- Div avec identifiant main1 -->
<form action="submit.php" method="post"> <!-- Formulaire avec action vers submit.php et méthode post -->
<div class="fieldset1"> <!-- Div avec classe fieldset1 -->
<div class=h2bis> <span style="color: rgb(195,211,13)";>REFERENT </div> <!-- Titre avec classe h2bis et style pour la couleur du texte -->
<br>
<div id="text_field1"> <!-- Div avec identifiant text_field1 -->
Nom: <input type="text" name="nom" value="<?php echo $nomref; ?>" 
Prénom: <input type="text" name="prenom" value="<?php echo $prenomref; ?>" 
Date de naissance: <input type="text" name="date" value="<?php echo $dateref; ?>"
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
<img src="logobleu2.png" class="background-logo" > <!-- Image avec chemin d'accès et classe background-logo -->
<?php
$target_dir = "uploads/"; <!-- Répertoire de destination pour les fichiers téléchargés -->
// Obtenez l'e-mail de l'utilisateur à partir de la session
if(isset($_SESSION["user_email"])) {
$user_email = $_SESSION["user_email"];
} else {
echo "Veuillez vous connecter pour télécharger un fichier."; <!-- Message d'erreur pour l'utilisateur non connecté -->
exit();
}
if (!file_exists($target_dir)) {
mkdir($target_dir, 0777, true); <!-- Création du répertoire s'il n'existe pas -->
}
// Remplacer le nom du fichier par l'email de l'utilisateur
$target_file = $target_dir . $user_email . ".pdf"; <!-- Chemin d'accès vers le fichier cible -->
$uploadOk = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST["submit"])) {
$fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION)); <!-- Obtenir l'extension du fichier -->
if($fileType != "pdf") {
echo "Seuls les fichiers PDF sont autorisés."; <!-- Message d'erreur si le fichier n'est pas au format PDF -->
$uploadOk = 0;
}
}
if ($uploadOk == 0) {
echo "Désolé, votre fichier n'a pas été téléchargé."; <!-- Message d'erreur si le fichier n'a pas été téléchargé -->
} else {
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
echo "Le fichier a été téléchargé avec succès."; <!-- Message de succès si le fichier a été téléchargé avec succès -->
} else {
echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier."; <!-- Message d'erreur s'il y a eu une erreur lors du téléchargement -->
}
}
}
$message = "Votre dossier a bien été pris en compte avec votre CV"; <!-- Message de confirmation -->
?>
<p class="message"><?php echo $message; ?></p> <!-- Paragraphe avec classe message affichant le message de confirmation -->



