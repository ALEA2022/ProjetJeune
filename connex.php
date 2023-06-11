<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="crea.css">
<title>Connexion</title>
</head>
<body>
<div class="container">
        <img src="logoJeunes.png" alt="Image" class="logo">
<form method="post" action="">
    <h4><i>CONNEXION</i></h4>
    <br><br> <br>
    <input type="email" name="email" placeholder="Email"><br>
   <input type="password" name="password" placeholder="Mot de passe"><br>
   <br>
    <input type="submit" name="submit" value="Se connecter"><br>
    <a href="mdp.php" class="btn" id="signin">Mot de passe oublié?</a>
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
            echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>Connecté avec succès!</p>";
            $_SESSION["user_email"] = $email;
            header("Location: accueilJeunes.php");
            fclose($file);
            return;
        }
    }
    echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>Identifiant ou mot de passe incorrect</p>";
    fclose($file);
}
?>

