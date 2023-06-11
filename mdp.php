<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="crea.css"> <!-- Fichier CSS pour le style -->
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <img src="logoJeunes.png" alt="Image" class="logo"> <!-- Logo -->
        <form method="post" action="">
            <h4><i>Entrez votre mail</i></h4>
            <br><br> <br>
            <input type="text" name="email" placeholder="Email"><br> <!-- Champ de saisie de l'email -->
            <input name="submit" type="submit" value="Envoyer"><br> <!-- Bouton pour soumettre le formulaire -->
            <form action="connex.php" method="post"> <!-- Formulaire pour la connexion -->
                <input type="submit" name="connex" value="Se connecter"><br> <!-- Bouton pour se connecter -->
            </form>
        </form><br>
    </div>
    <?php
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    if (isset($_POST['connex'])) { // Redirection vers la page de connexion si le bouton "Se connecter" est cliqué
        header('Location:connex.php');
    }

    if (isset($_POST['submit'])) { // Si le bouton "Envoyer" est cliqué
        $email = $_POST['email']; // Récupération de l'email saisi
        $file = fopen('comptes.csv', 'r'); // Ouvrir le fichier CSV en lecture
        $trouvé=0; // Variable pour vérifier si l'email a été trouvé dans le fichier
        while (($data = fgetcsv($file)) !== FALSE) { // Parcourir chaque ligne du fichier
            if ($data[0] == $email) { // Vérifier si l'email existe dans la première colonne
                $mail = new PHPMailer(true); // Créer une instance de PHPMailer
                try{ 
                    $mail->isSMTP();                                           
                    $mail->Host       = 'smtp.gmail.com';                  
                    $mail->Port       = 587;
                    $mail->SMTPAuth   = true;                                
                    $mail->Username   = 'mailjeunes6.4@gmail.com';                     
                    $mail->Password   = 'hlddoflplovfftkd';                              
                    $mail->SMTPSecure = 'tls'; 

                    $mail->setFrom('mailjeunes6.4@gmail.com'); // Adresse email de l'expéditeur
                    $mail->addAddress($email, 'alexandre'); // Adresse email du destinataire
                    $mail->Subject = 'Mot de passe oublié'; // Sujet du mail
                    $mail->Body = 'Votre mot de passe est : '.$data[3]; // Contenu du mail

                    $mail->SMTPOptions = array(
                        'ssl' => array (
                            'verify_peer' => false,
                            'verify_peer_name' =>false,
                            'allow_self_signed' =>true
                        )
                    );
                    $mail->send(); // Envoi du mail

                    echo"<p style='color: white; margin-top:40%; margin-left:-19%;'>Email envoyé</p>"; // Message de confirmation d'envoi

                } 
                catch(Exception $e) {
                    echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>Erreur envoi </p>" . $mail->ErrorInfo; // Message d'erreur en cas d'échec de l'envoi
                }
                $trouvé=1; // L'email a été trouvé, on met la variable à 1 pour le signaler

                break; // Sortir de la boucle
            }
        }
        fclose($file); // Fermer le fichier CSV
        if($trouvé==0){
            echo "<p style='color: white; margin-top:40%; margin-left:-19%;'>Votre adresse mail est incorrecte</p>"; // Message en cas d'email non trouvé dans le fichier
        }
    }
    ?>
</body>

</html>
