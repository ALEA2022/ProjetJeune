<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="crea.css"> <!-- Lien vers la feuille de style crea.css -->
<title>Connexion</title>
</head>
<body>
<div class="container">
        <img src="logoJeunes.png" alt="Image" class="logo"> <!-- Logo -->
<form method="post" action="">
    <h4><i>CONNEXION</i></h4> <!-- Titre de la section -->
    <br><br> <br>
    <input type="email" name="email" placeholder="Email"><br> <!-- Champ de saisie de l'email -->
   <input type="password" name="password" placeholder="Mot de passe"><br> <!-- Champ de saisie du mot de passe -->
   <br>
    <input type="submit" name="submit" value="Se connecter"><br> <!-- Bouton de soumission du formulaire -->
    <a href="mdp.php" class="btn" id="signin">Mot de passe oublié?</a> <!-- Lien vers la page mdp.php avec un style personnalisé -->
</form>
</div>

        
        
<?php
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $file = fopen('comptes.csv', 'r');

    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        if ($data[0] == $email && $data[3] == $password) {
            echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>Connecté avec succès!</p>"; // Message de succès de connexion
            $_SESSION["user_email"] = $email;
            header("Location: accueilJeunes.php"); // Redirection vers la page accueilJeunes.php
            fclose($file);
            return;
        }
    }
    echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>Identifiant ou mot de passe incorrect</p>"; // Message d'erreur d'identification
    fclose($file);
}
?>

