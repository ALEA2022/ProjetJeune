<?php
session_start();

if (isset($_SESSION["user_email"])) { // Vérifie si la variable de session "user_email" existe
    echo "L'utilisateur connecté est : " . $_SESSION["user_email"]; // Affiche l'email de l'utilisateur connecté
} else {
    echo "Personne n'est connecté."; // Affiche un message indiquant que personne n'est connecté
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Mon Site</title>
    <meta charset="UTF-8">
    <meta name="description" content="Description de mon site.">
    <meta name="keywords" content="Mots-clés, pour, mon, site.">
    <link rel="stylesheet" href="jeunes.css"> 
    <link rel="stylesheet" href="jeunescv.css"> 
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
        <a href="jeunes.php" class="jeunes"><span style="background-color:rgb(229, 0, 126); color: white";>JEUNES</a> <!-- Lien vers la page jeunes.php avec mise en forme -->
        <ul class="submenu">
          <li><a href="jeunes.php">Modification de profil</a></li> <!-- Sous-menu pour la modification du profil -->
          <li><a href="jeunescv.php">Téléchargement de CV</a></li> <!-- Sous-menu pour le téléchargement de CV -->
          <li><a href="accueilJeunes.php">Déconnexion</a></li> <!-- Sous-menu pour la déconnexion -->
        </ul>
      </li>
      <li class="menur">
        <a href="" class="referent">REFERENT</a>
      </li>
      <li class="menuc">
        <a href="" class="consultant">CONSULTANT</a>
      </li>
      <li class="menup">
        <a href="" class="partenaires">PARTENAIRES</a>
      </li>
      <li class="menua">
        <a href="" class="administrateur">ADMINISTRATEUR</a>
      </li>
    </ul>
    <h2>Décrivez votre experience et mettez en avant ce que vous en avez retiré.</h2>
    <div class="centered-form">
      <form action="uploads.php" class="btn" method="post" enctype="multipart/form-data" class="pink-form">
        Sélectionnez le fichier à télécharger:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>
        <input type="submit" class="btnT" value="Télécharger le fichier" name="submit">
      </form>
    </div>
