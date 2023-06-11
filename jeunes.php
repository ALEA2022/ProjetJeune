<script>
                    $(function() {
                      $("#datepicker").datepicker({
                        dateFormat: "dd/mm/yy",
                        changeYear: true,
                        yearRange: "1900:c+1",
                        showButtonPanel: true,
                        closeText: "Fermer",
                        currentText: "Aujourd'hui",
                        dayNamesMin: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                        monthNamesShort: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin", "Juil", "Aoû", "Sep", "Oct", "Nov", "Déc"]
                      });
                    });
                  </script>

<?php
session_start();

if (isset($_SESSION["user_email"])) {
   
} else {
    
}
?>


 <?php
    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $datenaissance = $_POST['date'];
        $email = $_SESSION["user_email"];
        $reseau = $_POST['reseau'];
        $engagement = $_POST['engagement'];
        $milieu = $_POST['milieu'];
        $emailReferentInput = $_POST['emailReferent'];
        $duree = $_POST['duree'];

        $file = fopen('file1.csv', 'a'); // Ouverture du fichier en mode ajout

        // Explode the referent emails by comma
        $emailReferents = explode(',', $emailReferentInput);
        foreach ($emailReferents as $emailReferent) {
            // Trim the email to remove any unnecessary spaces
            $emailReferent = trim($emailReferent);

            fputcsv($file, array($email,$nom, $prenom, $datenaissance,$reseau, $engagement, $milieu, $emailReferent, $duree)); // Ecriture des données dans le fichier CSV
        }

        fclose($file); // Fermeture du fichier
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
                  
                      $file = fopen('file2.csv', 'a'); // ouvrir le fichier en mode append
                  
                      // insérer tous les traits dans une nouvelle ligne
                      fputcsv($file, $traits);
                  
                      fclose($file); // fermer le fichier
                      header('Location: jeunescv.php');
                    }
    ?>
    <?php
      $file1 = fopen('file1.csv', 'r');
if (!$file1) {
    die('Impossible d\'ouvrir file1.csv');
}

$file2 = fopen('file2.csv', 'r');
if (!$file2) {
    die('Impossible d\'ouvrir file2.csv');
}

$fileCombined = fopen('fileCombined.csv', 'w');
if (!$fileCombined) {
    die('Impossible d\'ouvrir fileCombined.csv');
}

while (($data1 = fgetcsv($file1)) !== FALSE && ($data2 = fgetcsv($file2)) !== FALSE) {
    if (!$data1 || !$data2) {
        die('Erreur de lecture des données');
    }

    fputcsv($fileCombined, array_merge($data1, $data2));
}

fclose($file1);
fclose($file2);
fclose($fileCombined);
    ?>

<?php
    // Lire les deux fichiers CSV dans des tableaux
    $data1 = array_map('str_getcsv', file('comptes.csv'));
    $data2 = array_map('str_getcsv', file('fileCombined.csv'));

    // Créer un tableau associatif à partir du deuxième tableau, en utilisant la première valeur de chaque ligne comme clé
    $keys2 = [];
    foreach ($data1 as $line) {
        $key = $line[0];
        $keys2[$key] = $line;
    }

    // Parcourir le premier tableau et ajouter les données du deuxième tableau aux lignes correspondantes
    foreach ($data2 as &$line) {
        $key = $line[0];
        if (isset($keys2[$key])) {
            $line = array_merge($line, array_slice($keys2[$key], 2,-2));
        }
    }

    // Charger les données existantes de tmp.csv
    $tmpData = array_map('str_getcsv', file('tmp.csv'));

    // Parcourir chaque ligne de données dans fileCombined.csv
    foreach ($data2 as $newData) {
        $found = false;

        // Parcourir chaque ligne de données dans tmp.csv
        foreach ($tmpData as $key => $existingData) {
            // Vérifier si l'e-mail de l'utilisateur et l'e-mail du référent dans fileCombined.csv existent déjà dans tmp.csv
            if ($existingData[0] == $newData[0] && $existingData[7] == $newData[7]) {
                // Si c'est le cas, mettre à jour la ligne de tmp.csv avec les nouvelles données de fileCombined.csv
                $newData[13] = $existingData[13]; // Conserver l'identifiant unique existant
                $tmpData[$key] = $newData;
                $found = true;
                break;
            }
        }

        // Si l'e-mail de l'utilisateur et l'e-mail du référent n'ont pas été trouvés dans tmp.csv, ajouter les nouvelles données à tmp.csv
        if (!$found) {
            $uniqueId = md5($newData[0] . $newData[7] . time()); // Générer un identifiant unique
            $newData[13] = $uniqueId; // Ajouter l'identifiant unique à la nouvelle ligne de données
            $tmpData[] = $newData;
        }

        // Enregistrer l'identifiant unique dans la session
        $_SESSION['unique_id'] = $newData[13];
    }

    // Écrire les données mises à jour dans tmp.csv
    $file = fopen('tmp.csv', 'w');
    foreach ($tmpData as $data) {
        fputcsv($file, $data);
    }
    fclose($file);



    $file1 = fopen('file1.csv', 'w');
    fclose($file1);
    $file2 = fopen('file2.csv', 'w');
    fclose($file2);
    $file3 = fopen('fileCombined.csv', 'w');
    fclose($file3);


$ligneTrouvee = -1;

// Ouverture du fichier CSV
$file = fopen('tmp.csv', 'r');

// Index actuel de la ligne (commence à 1)
$indexLigne = 1;

// Lecture de chaque ligne du fichier CSV
while (($data = fgetcsv($file)) !== FALSE) {
    // Vérifie si la 14ème colonne (index 13 car l'indexation commence à 0) contient la valeur recherchée
    if ($data[13] == $_SESSION['unique_id']) {
        $ligneTrouvee = $indexLigne;
        break;
    }

    $indexLigne++;
}

// Fermeture du fichier CSV
fclose($file);
?>
<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    $emailReferentInput = $_POST['emailReferent'];

    $mail = new PHPMailer(true);
    try{ 
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';                  
        $mail->Port       = 587;
        $mail->SMTPAuth   = true;                                
        $mail->Username   = 'mailjeunes6.4@gmail.com';                     
        $mail->Password   = 'hlddoflplovfftkd';                              
        $mail->SMTPSecure = 'tls'; 
        
        $mail->setFrom('mailjeunes6.4@gmail.com');
        $mail->addAddress($emailReferentInput, 'alexandre');
        $mail->addAttachment('uploads/' . $_SESSION['user_email'] . '.pdf');
        $mail->Subject = 'Demande de referencement';
        $url = "http://localhost/ProjetJeune/referent.php?ligne=".$ligneTrouvee;
        $mail->Body = 'Cliquez sur ce lien pour accéder à la page : '.$url;

        $mail->SMTPOptions = array(
            'ssl' => array (
                'verify_peer' => false,
                'verify_peer_name' =>false,
                'allow_self_signed' =>true
            )
        );
        $mail->send();
        
        echo'Email envoyé';

    } catch(Exception $e) {
        echo 'Erreur envoi ' . $mail->ErrorInfo;
    }
}
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
<script>
        var textInput = document.getElementById('text-input');

        textInput.addEventListener('input', function() {
            textInput.style.color = 'green'; // Changer la couleur du texte en vert
        });
    </script>
    
    <style>
      .forbidden-cursor {
        cursor: not-allowed;
      }
    </style>
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/i18n/jquery-ui-i18n.min.js"></script>

</head>
</head>

  </head>
  <p class="footer-text"><span style="font-size: 80px; color: rgb(229, 0, 126)"; > JEUNE</p></span>
  <body>



  
  <script>
        $(document).ready(function() {
            $.datepicker.regional['fr'] = {
                closeText: 'Fermer',
                prevText: 'Précédent',
                nextText: 'Suivant',
                currentText: 'Aujourd\'hui',
                monthNames: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
                monthNamesShort: ['janv.', 'févr.', 'mars', 'avr.', 'mai', 'juin', 'juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'],
                dayNames: ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
                dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
                dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                weekHeader: 'Sem.',
                dateFormat: 'dd-mm-yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };

            $('#datepicker').datepicker({
                changeYear: true,
                yearRange: '-100:+0',
                onSelect: function(dateText, inst) {
                    $(this).datepicker("option", "dateFormat", "dd/mm/yy");
                }
            });
            $('#datepicker').datepicker('option', $.datepicker.regional['fr']);
        });
    </script>
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
      <li><a href="accueilJeunes.php">Déconnexion</a></li>
    </ul>
          </li>
          <li class="menur">
            <a href="" class="referent">REFERENT</a>
          </li>
          <li class="menuc">
            <a href="" class="consultant">CONSULTANT</a>
          </li>
          <li class="menup">
            <a href="partenaires.php" class="partenaires">PARTENAIRES</a>
          </li>
          <li class="menua">
            <a href="" class="administrateur">ADMINISTRATEUR</a>
          </li>
        </ul>
        <br>
        <h2>Décrivez votre experience et mettez en avant ce que vous en avez retiré.</h2>
        

        <div id="main">
          <form method="post" action="#">
                  <fieldset id="text_field">
                
                      <label for="nom">NOM : </label>
                      <input type="text" id="text-input" autocomplete="new-password" id="nom" name="nom" required><br>
          
                      <label for="prenom">PRENOM :</label>
                      <input type="text" id="text-input" autocomplete="new-password" id="prenom" name="prenom" required><br>
          

                      <label for="date">DATE DE NAISSANCE :</label>
                      <input type="text"  id="datepicker" id="text-input" name="date" required><br>
          
                      <label for="email">Mail :</label>
                      <input type="text" id="text-input" name="email" value="<?php echo $_SESSION["user_email"]; ?>" readonly><br>
          
                      <label for="reseau">Réseau social :</label>
                      <input type="text" id="text-input" autocomplete="new-password" id="reseau" name="reseau"><br>
                      
                      <label for="engagement">Mon engagement :</label>
                      <input type="text" id="text-input" autocomplete="new-password" id="engagement" name="engagement"><br>
                      <label for="milieu">Milieu engagement :</label>
                      <input type="text" id="text-input" autocomplete="new-password" id="milieu" name="milieu"><br>
                      <label for="emailReferent">Mail du Référent :</label>
                      <input type="email" id="text-input" id="email" name="emailReferent" required><br>
                      <label for="duree">DUREE :</label>
                      <input type="text" id="text-input" autocomplete="new-password" id="duree" name="duree"><br><br>
                  </fieldset>
              </div> 

                <!--formulaire checkbox sur la droite-->
                
               <!--formulaire checkbox sur la droite-->
                
               <div id="right">
                <form method="post" action="exemple.html">
                  <fieldset id="field_checkbox">
                  <legend><span style="font-size: 12px; color: rgb(229, 0, 126)"; >MES SAVOIRS ETRE</span></legend>
                  <div id="dv_checkbox">
                    <div class="titlecheck">
                  <div class="jesuis"> Je suis*</div>
                  </div>
                  <div>
                    <br><br>
                    <input type="checkbox" id="autonome" name="traits[]" value="Autonome">
                    <label for="autonome">Autonome</label>
                  </div>
                  <div>
                    <input type="checkbox" id="passionne" name="traits[]" value="Passionné">
                    <label for="passionne">Passionné</label>
                  </div>
                  <div>
                <input type="checkbox" id="ecoute" name="traits[]" value="A l'écoute">
                <label for="ecoute">A l'écoute</label>
            </div>

            <div>
                <input type="checkbox" id="organise" name="traits[]" value="Organisé">
                <label for="organise">Organisé</label>
            </div>

            <div>
                <input type="checkbox" id="fiable" name="traits[]" value="Fiable">
                <label for="fiable">Fiable</label>
            </div>

            <div>
                <input type="checkbox" id="patient" name="traits[]" value="Patient">
                <label for="patient">Patient</label>
            </div>

            <div>
                <input type="checkbox" id="reflechi" name="traits[]" value="Réfléchi">
                <label for="reflechi">Réfléchi</label>
            </div>

            <div>
                <input type="checkbox" id="responsable" name="traits[]" value="Responsable">
                <label for="responsable">Responsable</label>
            </div>

            <div>
                <input type="checkbox" id="sociable" name="traits[]" value="Sociable">
                <label for="sociable">Sociable</label>
            </div>
        
            <div>
                <input type="checkbox" id="optimiste" name="traits[]" value="Optimiste">
                <label for="optimiste">Optimiste</label>
            </div>
        </div>
                        
                  </fieldset>
                  <p><small>*Faire 4 choix maximum</small></p>

    <input type="submit" class="btn" name="submit" value="Valider">
</form>
            </div>
<img src="logorose1.png" class="background-logo" >
      
       
</body>
</html>
