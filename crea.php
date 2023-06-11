<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="crea.css"> 
    <title>Création de Compte</title> 
</head>
<body>
<div class="container">
        <img src="logoJeunes.png" alt="Image" class="logo"> <!-- Logo de l'application -->
<form method="post" action=""> <!-- Début du formulaire d'inscription -->
    <h4><i> INSCRIPTION</i></h4>
     <input type="text" name="nom" placeholder="Nom"><br>
     <input type="text" name="prenom" placeholder="Prénom"><br>
     <input type="email" name="email" placeholder="Email"><br>
     <input type="password" name="password" placeholder="Mot de passe"><br>
    <input type="submit" name="submit" value="Créer un compte"><br>
    <a href="connex.php" class="btn" id="signin">Connexion</a> <!-- Bouton pour aller à la page de connexion -->
</form>
</div>

    
    
<?php
if (isset($_POST['submit'])) { // Si le bouton "submit" a été cliqué
    // Récupère les informations du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $file = fopen('comptes.csv', 'a+'); // Ouvre le fichier "comptes.csv" en mode lecture et écriture, et le crée s'il n'existe pas

    // Boucle à travers chaque ligne du fichier
    while (($data = fgetcsv($file)) !== FALSE) { // fgetcsv() lit la ligne actuelle du fichier CSV
        // Si l'email existe déjà dans le fichier, affiche un message et termine le script
        if ($data[0] == $email) {
            echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>L'adresse e-mail existe déjà.</p>";
            fclose($file); // Ferme le fichier
            return; // Termine le script
        }
    }

    // Si l'email n'existe pas dans le fichier, ajoute une nouvelle ligne avec les informations du nouveau compte
    fputcsv($file, array( $email, $nom, $prenom, $password));

    fclose($file); // Ferme le fichier

    echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>Compte créé avec succès!</p>"; // Affiche un message de réussite
}
?>
</body>
</html>
