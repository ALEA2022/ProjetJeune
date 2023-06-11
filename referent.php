<?php
    // Récupération du numéro de ligne à partir de l'URL
    $ligne = isset($_GET['ligne']) ? intval($_GET['ligne']) - 1 : 0;

    // Ouverture du fichier CSV
    $file = fopen('tmp.csv', 'r');

    // Création d'un tableau pour stocker toutes les données
    $data = [];

    // Lecture de chaque ligne du fichier CSV
    while (($line = fgetcsv($file)) !== FALSE) {
        // Ajout de la ligne au tableau de données
        $data[] = $line;
    }

    // Fermeture du fichier CSV
    fclose($file);

    // Vérification que le numéro de ligne est valide
    if ($ligne < 0 || $ligne >= count($data)) {
        die("Numéro de ligne invalide");
    }

    // Extraction des données de la ligne spécifiée
    $data = $data[$ligne];
    $emailJeune = $data[0];
    $nom = $data[2];
    $prenom = $data[1];
    ?>

<script>
window.onload = function() {
let checkboxes = document.querySelectorAll('#dv_checkbox input[type="checkbox"]');

checkboxes.forEach(checkbox => {
checkbox.addEventListener('change', function(e) {
let checked = document.querySelectorAll('#dv_checkbox input[type="checkbox"]:checked').length;

if(checked > 4) {
    alert("Vous ne pouvez sélectionner que 4 options maximum.");
    e.target.checked = false;
}
});
});
}


</script>

<!DOCTYPE html>
<html>
  <head>
    <title>Mon Site</title>
    <meta charset="UTF-8">
    <meta name="description" content="Description de mon site.">
    <meta name="keywords" content="Mots-clés, pour, mon, site.">
    <link rel="stylesheet" href="referent.css">
  </head>
  <p class="footer-text"><span style="font-size: 80px; color:rgb(195, 204, 82)"; > REFERENT</p></span>
  <body>
    
      
      <header class="top-bar">
        <div class="element">

          <img src="logoJeunes.png" alt="Image">
        </div>
        <footer>
          <p class="footer-text"><span style="font-size: 35px";>Je confirme la valeur de ton engagment</p>
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
            <a href="référent.php" class="referent"><span style="background-color: rgb(19, 165, 57); color: white";>REFERENT</a>
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
        <h2>Confirmez cette expérience et ce que vous avez <br> pu constater au contact de ce jeune.</h2>
        <div class="recup">
          <br>
        <form action="submit.php" method="post">
          Email: <input type="text"  id="text-input" name="email" value="<?php echo $emailJeune; ?>" readonly><br>
          Nom: <input type="text"  id="text-input" name="nom" value="<?php echo $nom; ?>"readonly><br>
          Prenom: <input type="text"  id="text-input" name="prenom" value="<?php echo $prenom; ?>"readonly><br>
          </div>
        </form>
        <div id="main">
          <form method="post" action="#">
                  <fieldset id="text_field">
                     
                      <label for="nom">NOM :</label>
                      <input type="text"  id="text-input" autocomplete="new-password" id="nom" name="nom" required><br>
          
                      <label for="prenom">PRENOM :</label>
                      <input type="text"  id="text-input" autocomplete="new-password" id="prenom" name="prenom" required><br>
          
                      <label for="date">DATE DE NAISSANCE :</label>
                      <input type="text"  id="text-input" autocomplete="new-password" id="datepicker" id="date" name="date" required><br>
          
                      <label for="email">Mail :</label>
                      <input type="email"  id="text-input" autocomplete="new-password" id="email" id="email" name="email" required><br>
          
                      <label for="reseau">Réseau social :</label>
                      <input type="text"  id="text-input" autocomplete="new-password" id="reseau" name="reseau"><br>
                      <label for="presentation">Presentation :</label>
                      <input type="text"  id="text-input" autocomplete="new-password" id="presentation" name="presentation" required><br>
                      <label for="duree">DUREE :</label>
                      <input type="text"  id="text-input" autocomplete="new-password" id="duree" name="duree"><br><br>
                  </fieldset>
              </div>  
       
               

                <!--formulaire checkbox sur la droite-->
                
                <div id="right">
                <form method="post" action="exemple.html">
                  <fieldset id="field_checkbox">
                  <legend><span style="font-size: 12px; color: rgb(195,211,13)"; >SES SAVOIRS ETRE</span></legend>
                  <div id="dv_checkbox">
                  <div class="titlecheck">
                  <div class="jesuis">Je confirme sa (son)*</div>
                  </div>
                  <br><br>
                  <div>
                    <input type="checkbox" id="confiance" name="traits[]" value="Confiance">
                    <label for="confiance">Confiance</label>
                  </div>
                  <div>
                    <input type="checkbox" id="bienveillance" name="traits[]" value="Bienveillance">
                    <label for="bienveillance">Bienveillance</label>
                  </div>
                  <div>
                                <input type="checkbox" id="respect" name="traits[]" value="Respect">
                                <label for="respect">Respect</label>
                            </div>
            
                            <div>
                                <input type="checkbox" id="honnetete" name="traits[]" value="Honnêteté">
                                <label for="honnetete">Honnêteté</label>
                            </div>
            
                            <div>
                                <input type="checkbox" id="tolerance" name="traits[]" value="Tolérance">
                                <label for="tolerance">Tolérance</label>
                            </div>
            
                            <div>
                                <input type="checkbox" id="juste" name="traits[]" value="Juste">
                                <label for="juste">Juste</label>
                            </div>
            
                            <div>
                                <input type="checkbox" id="impartial" name="traits[]" value="Impartial">
                                <label for="impartial">Impartial</label>
                            </div>
            
                            <div>
                                <input type="checkbox" id="travail" name="traits[]" value="Travail">
                                <label for="travail">Travail</label>
                            </div>
                        
                  </fieldset>
                  <p><small>*Faire 4 choix maximum</small></p>
                  </div>
                  <textarea name="comment" rows="5" cols="50">
Entrez un commentaire...</textarea>
<input type="submit" name="submit" value="Soumettre">
</form>
            
    <img src="logovert1.png" class="background-logo" >
</form>

        <body>

<html>

<?php
    if (isset($_POST['submit'])) {
    $email = $_POST['email']; // adresse mail rempli dans le formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $reseau = $_POST['reseau'];
    $presentation = $_POST['presentation'];
    $duree = $_POST['duree'];

        $file1 = fopen('ref1.csv', 'a'); // Ouverture du fichier en mode ajout

            fputcsv($file1, array($emailJeune, $email, $nom, $prenom, $date, $reseau, $presentation, $duree,)); // Ecriture des données dans le fichier CSV

        fclose($file1); // Fermeture du fichier
    }
?>

<?php
                    if (isset($_POST['submit'])) {
                      $traits = $_POST['traits'];
                      $arraySize = count($traits);

// Si la taille du tableau est inférieure à 4, compléter le tableau avec des espaces
                    if ($arraySize < 4) {
                     $traits = array_pad($traits, 4, ' ');
                          }
                  
                      $file2 = fopen('ref2.csv', 'a'); // ouvrir le fichier en mode append
                  
                      // insérer tous les traits dans une nouvelle ligne
                      fputcsv($file2, $traits);
                  
                      fclose($file2); // fermer le fichier
                    }
    ?>

<?php
$file1 = fopen('ref1.csv', 'r');
$file2 = fopen('ref2.csv', 'r');
$fileCombined = fopen('refCombined.csv', 'r+');

// Création d'un tableau associatif pour stocker les données
$dataCombined = [];

// Lecture des données du fichier combiné
while (($data = fgetcsv($fileCombined)) !== FALSE) {
    // Clé basée sur les deux premières données
    $key = $data[0] . ',' . $data[1];

    // Ajout des données au tableau
    $dataCombined[$key] = $data;
}

// Lecture des données de chaque fichier
while (($data1 = fgetcsv($file1)) !== FALSE && ($data2 = fgetcsv($file2)) !== FALSE) {
    if (!$data1 || !$data2) {
        die('Erreur de lecture des données');
    }

    // Clé basée sur les deux premières données
    $key = $data1[0] . ',' . $data1[1];

    // Vérification si la clé existe déjà dans le tableau
    if (array_key_exists($key, $dataCombined)) {
        // Si elle existe, mise à jour des données
        echo "existe";
        for ($i = 2; $i < count($data1); $i++) {
            $dataCombined[$key][$i] = $data1[$i];
        }
        for ($i = 0; $i < count($data2); $i++) {
            $dataCombined[$key][count($data1) + $i] = $data2[$i];
        }
    } else {
        // Si elle n'existe pas, ajout des nouvelles données au tableau
        $dataCombined[$key] = array_merge($data1, $data2);
    }
}

// Suppression de l'ancien contenu du fichier combiné
ftruncate($fileCombined, 0);
rewind($fileCombined);

// Écriture des données combinées dans le fichier final
foreach ($dataCombined as $data) {
    fputcsv($fileCombined, $data);
}

// Fermeture des fichiers
fclose($file1);
fclose($file2);
fclose($fileCombined);

$file1 = fopen('ref1.csv', 'w');
fclose($file1);
$file2 = fopen('ref2.csv', 'w');
fclose($file2);
?>